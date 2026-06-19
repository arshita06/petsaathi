<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Category::all();

        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();
        return redirect()->route('admin.category.index')->with('Category created successfully');
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
        $data['category'] = Category::findOrFail($id);

        return view('categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();
        return redirect()->route('admin.category.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Category::findorFail($id);
        $delete->delete();
        return redirect()->route('admin.category.index')->with('success','Category deleted successfully');
    }
}
