<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Category::all();

        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
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
        $category->description = $request->description;
        if($request->hasFile('image')){
            $image = $request->File('image');
            $imageName = time() . '_'. str_replace(' ',' _', $image->getclientoriginalname());
            $image = $image->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName ;
        }
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

        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all());
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->description = $request->description;
        if($request->hasFile('image')){
            if($category->image && file_exists(public_path($category->image))){
                File::delete(public_path('$category->image'));
            }
        $image = $request->file('image');
        $imageName = time(). '_' . str_replace(' ', '_', $image->getclientoriginalname());
        $image = $image->move(public_path('uploads/categories'), $imageName);
        $category->image = 'uploads/categories/' . $imageName;
        }
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
