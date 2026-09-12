<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
}
