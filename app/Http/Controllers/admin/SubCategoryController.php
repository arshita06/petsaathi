<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['subcategory'] = SubCategory::all();
        // dd($data);
        return view('subcategories.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::with('subcategory')->get();
        // dd( $data['categories']);

        return view('subcategories.create', $data);
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

        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->is_active = $request->is_active;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . str_replace(' ', '_', $image->getClientOriginalName());
            $image->move(public_path('uploads/subcategories'), $imageName);
            $subcategory->image = 'uploads/subcategories/' . $imageName;
        }
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

        return view('subcategories.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->is_active = $request->is_active;
        if($request->hasFile('image')){
            if($subcategory->image && File::exists(public_path($subcategory->image))){
                File::delete(public_path($subcategory->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . str_replace(' ' , '_',$image->getClientOriginalName());
            $image->move(public_path('uploads/subcategories'), $imageName);
            $subcategory->image = 'uploads/subcategories/'. $imageName;

        };
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
