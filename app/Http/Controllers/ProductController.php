<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

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
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->subcategory_id = $request->subcategory_id;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->status = $request->is_active;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . str_replace(' ', '_', $image->getClientOriginalName());
            $image = $image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/' . $imageName;

        }
        $product->save();
        // dd($product);
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
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
        $data['product'] = Product::findOrFail($id);
        $data['subcategories'] = SubCategory::where('is_active',1)->where('deleted_at', null)->pluck('name', 'id');
        $data['categories'] = Category::where('is_active',1)->where('deleted_at', null)->pluck('name', 'id');
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product->name = $request->name;
        $product->subcategory_id = $request->subcategory_id;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->status = $request->is_active;
        if($request->hasFile('image')){
            if($product->image && file_exists(public_path($product->image))){
                file::delete(public_path($product->image));
            }
            $image = $request->hasFile('image');
            $imageName = time() . '_' . str_replace(' ', '_', $image->geyclientOriginalName());
            $image = $image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/' . $imageNmae;
        }
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product  = Product::findorfail($id);
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
}
