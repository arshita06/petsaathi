<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.(
     */
    public function index()
    {
        $data['products'] = Product::with(['subcategory.category', 'subcategory'])->whereHas('subcategory', function ($q){
            $q->where('is_active', 1)
            ->where('deleted_at',null);
        })->whereHas('subcategory.category', function ($q){
            $q->where('is_active', 1)
            ->where('deleted_at', null);
        })->get();
        // dd($data['products']);
        return view('products.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['subcategories'] = SubCategory::where('is_active',1)->where('deleted_at', null)->pluck('name', 'id');
        $data['categories'] = Category::where('is_active',1)->where('deleted_at', null)->pluck('name', 'id');
        return view('products.create', $data);
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
        //
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
