<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Wishlist;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $shops = Product::with(['subcategory', 'subcategory.category'])->whereHas('subcategory', function($q){
            $q->where('is_active',1)->where('deleted_at', null);
            })
            ->whereHas('subcategory.category', function($q){
                $q->where('is_active',1)->where('deleted_at', null);
            });

        if($request->filled('search'))
        {
            $shops->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if($request->filled('max_prize'))
        {
            $shops->where('discount_price', '<=', $request->max_prize );
        }

        if($request->filled('min_prize'))
        {
            $shops->where('discount_price', '>=', $request->min_prize );
        }

       if($request->filled('category_id'))
        {
            $shops->whereHas('subcategory.category', function($q) use ($request){
                $q->where('id', $request->category_id);
            });
        }

        if($request->filled('subcategory_id'))
        {
            $shops->where('subcategory_id', $request->subcategory_id);
        }
        $categories = Category::with(['subcategories' => function ($query) {
            $query->where('is_active', 1)->where('deleted_at', null);
        }])->where('is_active', 1)->where('deleted_at', null)->get();
        $selectedCategoryId = $request->filled('category_id') ? (int) $request->category_id : null;
        $selectedCategory = $selectedCategoryId
            ? $categories->firstWhere('id', $selectedCategoryId)
            : null;

        $data['shops'] = $shops->get();
        $data['categories'] = $categories;
        $data['selectedCategory'] = $selectedCategory;

    
        $data['wishlistIds'] = auth()->check()
            ? Wishlist::where('user_id', auth()->id())->pluck('product_id')->all()
            : [];

        return view('petsaathi.shop', $data);
    }
}
