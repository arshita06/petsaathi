<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Emoji used for the little icon tiles. Matched on the range name so a new
     * range added from the admin panel still gets a sensible icon instead of a
     * blank square; anything unrecognised falls back to a paw.
     */
    protected const ICONS = [
        'food' => '🍲',
        'treat' => '🦴',
        'toy' => '🧸',
        'health' => '🩺',
        'groom' => '🧴',
        'accessor' => '🎀',
        'cloth' => '🧥',
        'bed' => '🛏️',
        'train' => '🎾',
        'dog' => '🐶',
        'pup' => '🐶',
        'cat' => '🐱',
        'kitten' => '🐱',
        'bird' => '🐦',
        'fish' => '🐠',
        'rabbit' => '🐰',
    ];

    public function index(): View
    {
        $categories = Category::where('is_active', 1)->orderBy('name')->get();

        // The storefront is organised by sub-category (Food, Toys, Grooming…),
        // so those make the more useful "what we stock" strip.
        $ranges = SubCategory::with('category')
            ->where('is_active', 1)
            ->whereHas('category', fn ($q) => $q->where('is_active', 1))
            ->orderBy('name')
            ->get()
            ->map(fn (SubCategory $s) => [
                'name' => Str::title($s->name),
                'icon' => $this->iconFor($s->name),
                'parent' => $s->category?->name,
                'count' => Product::where('subcategory_id', $s->id)->where('status', 1)->count(),
                'url' => route('shop', ['category_id' => $s->category_id]),
            ]);

        return view('petsaathi.about', [
            'ranges' => $ranges,
            'petTypes' => $categories->map(fn (Category $c) => [
                'name' => Str::title($c->name),
                'icon' => $this->iconFor($c->name),
            ]),
            'stats' => [
                'customers' => User::where('is_active', 1)->count(),
                'products' => Product::where('status', 1)->count(),
                'ranges' => $ranges->count(),
            ],
        ]);
    }

    protected function iconFor(?string $name): string
    {
        $name = Str::lower($name ?? '');

        foreach (self::ICONS as $needle => $icon) {
            if (str_contains($name, $needle)) {
                return $icon;
            }
        }

        return '🐾';
    }
}
