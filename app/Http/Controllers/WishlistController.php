<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['wishlists'] = Wishlist::with(['product', 'user'])->whereHas('product', function($q){
            $q->where('deleted_at', null)
            ->where('status',1);
        })->whereHas('user', function($q){
            $q->where('is_active', 1)
            ->where('deleted_at', null);
        })->get();
        // dd($data['wishlist']);
        return view('wishlist.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['products'] = Product::with('wishlist')->wherehas('wishlist', function ($query){
            $query->where('deleted_at', null);
        })->get();
        $data['users'] = User::where('is_active', 1)->where('deleted_at', null)->get();
        return view('wishlist.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
