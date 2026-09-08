<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category()

    {
        $data['categories'] = Category::where('is_active', 1)->where('deleted_at', null)->get();

        return view('petsaathi.categories', $data);

    }
    
}
