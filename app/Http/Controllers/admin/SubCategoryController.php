<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['subcategory'] = SubCategory::all();
        // dd($data);
        return view('categories.subcategories.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::with('subcategory')->get();
        // dd( $data['categories']);

        return view('categories.subcategories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            ]);
        $imagePath = $request->file('image')->store('Subcategories', 'public');
        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->is_active = $request->is_active;
        $subcategory->image = $imagePath;
        $subcategory->save();
        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory Created succesfully');



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
        $data['subcategory'] = SubCategory::findorFail($id);
        $data['categories'] = Category::with('subcategory')->get();

        return view('categories.subcategories.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $imagePath = $request->file('image')->store('Subcategories', 'public');
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->is_active = $request->is_active;
        $subcategory->image = $imagePath;
        $subcategory->save();
        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = SubCategory::findorFail($id);
        $delete->delete();
        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory deleted succesfully');
    }
}
