<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $data['products'] = Product::with(['subcategory.category'])
            ->where('status', 1)
            ->whereHas('subcategory', function ($q) {
                $q->where('is_active', 1)
                    ->where('deleted_at', null);
            })
            ->whereHas('subcategory.category', function ($q) {
                $q->where('is_active', 1)
                    ->where('deleted_at', null);
            })
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->take(8)
            ->get();

        $data['stats'] = [
            'customers' => User::where('is_active', 1)->where('deleted_at', null)->count(),
            'products' => Product::where('status', 1)->count(),
        ];

        return view('petsaathi.home', $data);
    }
}
