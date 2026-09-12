<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * The customer-facing wishlist.
 *
 * How it works in one line: the `wishlist` table stores one row per
 * (user_id + product_id) pair, so "is this product saved?" is simply
 * "does a row exist for me and this product?".
 */
class WishlistController extends Controller
{
    /**
     * Show every product the logged-in user has saved.
     */
    public function index(): View
    {
        $items = Wishlist::with('product.subcategory')
            ->where('user_id', auth()->id())
            ->whereHas('product', fn ($q) => $q->where('status', 1))
            ->latest()
            ->get();

        return view('petsaathi.wishlist', ['items' => $items]);
    }

    /**
     * One button does both jobs: save the product if it is not saved yet,
     * remove it if it already is. That is why it is called "toggle".
     */
    public function toggle(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $item = Wishlist::withTrashed()
            ->where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if (! $item) {
            // Never saved before, so make a brand new row.
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            $message = 'Saved to your wishlist. ❤️';
        } elseif ($item->trashed()) {
            // Saved before and then removed, so just bring the old row back.
            $item->restore();
            $message = 'Saved to your wishlist. ❤️';
        } else {
            // Currently saved, so remove it.
            $item->delete();
            $message = 'Removed from your wishlist.';
        }

        // back() returns the customer to the page they clicked from,
        // whether that was the shop page or the wishlist page.
        return back()->with('wishlist_status', $message);
    }
}
