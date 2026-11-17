<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category(Request $request)
    {
        $categories = Category::with(['subcategories' => function ($query) {
                $query->where('is_active', 1)
                    ->where('deleted_at', null)
                    ->withCount(['products' => function ($productQuery) {
                        $productQuery->where('status', 1)->where('deleted_at', null);
                    }]);
            }])
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->get();

        $selectedCategory = $request->filled('category')
            ? $categories->firstWhere('id', (int) $request->category)
            : $categories->first();

        if (! $selectedCategory && $categories->isNotEmpty()) {
            $selectedCategory = $categories->first();
        }

        return view('petsaathi.categories', [
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);

    }
    
}
