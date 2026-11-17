<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * The shopping cart.
 *
 * It works just like the wishlist: the `carts` table holds one row per
 * (user_id + product_id) pair. The only extra is a `quantity` column,
 * so buying three of something is one row with quantity = 3.
 */
class CartController extends Controller
{
    /** Orders below this amount pay for delivery (matches the top bar). */
    public const FREE_SHIPPING_ABOVE = 999;

    /** What we charge when the order is under that amount. */
    public const SHIPPING_CHARGE = 49;

    /**
     * Show the cart with its totals.
     */
    public function index(): View
    {
        $items = Cart::with('product.subcategory')
            ->where('user_id', auth()->id())
            // Skip rows whose product the admin later hid or deleted.
            ->whereHas('product', fn ($q) => $q->where('status', 1))
            ->latest()
            ->get();

        // Add up every line to get the subtotal.
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item->lineTotal();
        }

        // Delivery is free once the order is big enough.
        $shipping = ($subtotal > 0 && $subtotal < self::FREE_SHIPPING_ABOVE)
            ? self::SHIPPING_CHARGE
            : 0;

        return view('petsaathi.cart', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ]);
    }

    /**
     * Show checkout using the real database cart.
     */
    public function checkout(): View|RedirectResponse
    {
        $summary = $this->cartSummary();

        if ($summary['items']->isEmpty()) {
            return redirect()->route('cart')->with('cart_error', 'Your cart is empty. Add products before checkout.');
        }

        return view('petsaathi.checkout', $summary);
    }

    /**
     * Create a real order. For now only Cash on Delivery is enabled.
     */
    public function placeOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fullName' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'pincode' => ['required', 'regex:/^\d{6}$/'],
            'address' => ['required', 'string', 'max:191'],
            'city' => ['required', 'string', 'max:191'],
            'state' => ['required', 'string', 'max:191'],
            'country' => ['required', 'string', 'max:191'],
            'instructions' => ['nullable', 'string', 'max:191'],
            'paymentMethod' => ['required', 'in:cod'],
        ], [
            'paymentMethod.in' => 'Only Cash on Delivery is available right now.',
        ]);

        $summary = $this->cartSummary();

        if ($summary['items']->isEmpty()) {
            return redirect()->route('cart')->with('cart_error', 'Your cart is empty. Add products before checkout.');
        }

        try {
            $order = DB::transaction(function () use ($summary, $validated) {
                foreach ($summary['items'] as $item) {
                    $product = Product::whereKey($item->product_id)->lockForUpdate()->firstOrFail();

                    if ($product->stock < $item->quantity) {
                        throw new \RuntimeException($product->name.' has only '.$product->stock.' item(s) left in stock.');
                    }
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'payment_method' => 'Cash on Delivery',
                    'total_amount' => $summary['total'],
                    'total_shipping_charge' => $summary['shipping'],
                    'status' => 'pending',
                    'shipping_status' => 'pending',
                    'shipping_remark' => $validated['instructions'] ?? null,
                    'utr_no' => null,
                    'shipping_name' => $validated['fullName'],
                    'shipping_email' => $validated['email'],
                    'shipping_mobile' => $validated['phone'],
                    'shipping_address' => $validated['address'],
                    'shipping_country' => $validated['country'],
                    'shipping_state' => $validated['state'],
                    'shipping_city' => $validated['city'],
                    'shipping_zip_code' => $validated['pincode'],
                    'payment_status' => 0,
                    'place_time' => now(),
                ]);

                foreach ($summary['items'] as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                    ]);

                    Product::whereKey($item->product_id)->decrement('stock', $item->quantity);
                }

                Cart::where('user_id', auth()->id())->delete();

                return $order;
            });
        } catch (\RuntimeException $exception) {
            return back()->withInput()->with('checkout_error', $exception->getMessage());
        }

        return redirect()->route('order.success', $order)->with('order_status', 'Order placed successfully.');
    }

    /**
     * Show the confirmation for a real order.
     */
    public function orderSuccess(?Order $order = null): View|RedirectResponse
    {
        if (! $order) {
            return redirect()->route('cart');
        }

        abort_unless($order->user_id === auth()->id(), 403);

        return view('petsaathi.order-success', ['order' => $order]);
    }

    /**
     * Show the logged-in customer's real order history.
     */
    public function orderHistory(): View
    {
        $orders = Order::with(['orderItem.product.subcategory'])
            ->where('user_id', auth()->id())
            ->latest('place_time')
            ->latest()
            ->get();

        return view('petsaathi.order-history', [
            'orders' => $orders,
            'totalOrders' => $orders->count(),
            'totalSpent' => $orders->sum('total_amount'),
            'activeOrders' => $orders->whereNotIn('shipping_status', ['delivered', 'cancelled'])->count(),
        ]);
    }

    /**
     * "Add" button on the shop / home / wishlist pages.
     * Already in the cart? Add one more. Otherwise create the row.
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < 1) {
            return back()->with('cart_error', $product->name.' is out of stock.');
        }

        $item = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            // Never let the quantity climb past what is actually in stock.
            $item->quantity = min($item->quantity + 1, $product->stock);
            $item->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('cart_status', $product->name.' added to your cart. 🛒');
    }

    /**
     * The quantity box on the cart page.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'cart_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        // Finding it by id AND user_id makes sure nobody can edit
        // someone else's cart by typing a different id.
        $item = Cart::with('product')
            ->where('user_id', auth()->id())
            ->findOrFail($request->cart_id);

        $item->quantity = min($request->quantity, max($item->product->stock, 1));
        $item->save();

        return back()->with('cart_status', 'Quantity updated.');
    }

    /**
     * The remove (✕) button on the cart page.
     */
    public function remove(Request $request): RedirectResponse
    {
        $request->validate([
            'cart_id' => ['required', 'integer'],
        ]);

        $item = Cart::where('user_id', auth()->id())->findOrFail($request->cart_id);
        $item->delete();

        return back()->with('cart_status', 'Item removed from your cart.');
    }

    /**
     * The same totals used by cart, checkout and order creation.
     */
    private function cartSummary(): array
    {
        $items = Cart::with('product.subcategory')
            ->where('user_id', auth()->id())
            ->whereHas('product', fn ($q) => $q->where('status', 1))
            ->latest()
            ->get();

        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item->lineTotal();
        }

        $shipping = ($subtotal > 0 && $subtotal < self::FREE_SHIPPING_ABOVE)
            ? self::SHIPPING_CHARGE
            : 0;

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ];
    }
}
