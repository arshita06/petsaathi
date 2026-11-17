<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Complete storefront catalogue for demo and local development.
     *
     * Existing rows are updated by name, so the seeder can run many times
     * without creating duplicate categories, subcategories or products.
     */
    protected array $catalogue = [
        [
            'name' => 'Dog',
            'description' => 'Food, care and playful essentials for happy dogs.',
            'image' => 'uploads/categories/1789281174_images_(6).jpg',
            'subcategories' => [
                [
                    'name' => 'Food',
                    'image' => 'uploads/subcategories/1784462278_dog_food.avif',
                    'products' => [
                        [
                            'name' => 'Pedigree Adult Dog Food',
                            'price' => 500,
                            'discount_price' => 450,
                            'stock' => 20,
                            'image' => 'uploads/products/1787740712_images.jpg',
                            'is_featured' => 1,
                            'description' => 'Balanced daily nutrition for adult dogs with protein, fibre and essential vitamins.',
                        ],
                        [
                            'name' => 'Premium Puppy Food',
                            'price' => 1199,
                            'discount_price' => 899,
                            'stock' => 40,
                            'image' => 'uploads/products/1787742748_images_(1).jpg',
                            'is_featured' => 0,
                            'description' => 'Complete nutrition for growing puppies, packed with calcium and omega-3.',
                        ],
                        [
                            'name' => 'Chicken & Rice Adult Dog Food',
                            'price' => 1499,
                            'discount_price' => 1249,
                            'stock' => 45,
                            'image' => 'uploads/products/1787742793_images_(2).jpg',
                            'is_featured' => 0,
                            'description' => 'Everyday wholegrain meal for adult dogs, made with real chicken and digestible rice.',
                        ],
                    ],
                ],
                [
                    'name' => 'Healthcare',
                    'image' => 'uploads/products/1787742846_images_(3).jpg',
                    'products' => [
                        [
                            'name' => 'Dental Care Chew Sticks',
                            'price' => 499,
                            'discount_price' => 349,
                            'stock' => 60,
                            'image' => 'uploads/products/1787742846_images_(3).jpg',
                            'is_featured' => 1,
                            'description' => 'Vet-approved chew sticks that reduce tartar build-up and freshen breath.',
                        ],
                        [
                            'name' => 'Pet First Aid Kit',
                            'price' => 999,
                            'discount_price' => 799,
                            'stock' => 25,
                            'image' => 'uploads/products/1787742888_images_(4).jpg',
                            'is_featured' => 0,
                            'description' => 'Compact emergency kit with bandages, antiseptic wipes, tweezers and tick remover.',
                        ],
                    ],
                ],
                [
                    'name' => 'Grooming',
                    'image' => 'uploads/products/1787742929_images_(5).jpg',
                    'products' => [
                        [
                            'name' => 'Lavender Grooming Shampoo',
                            'price' => 699,
                            'discount_price' => 549,
                            'stock' => 32,
                            'image' => 'uploads/products/1787742929_images_(5).jpg',
                            'is_featured' => 0,
                            'description' => 'Gentle shampoo with lavender and aloe vera for sensitive coats.',
                        ],
                        [
                            'name' => 'Soft Bristle Grooming Brush',
                            'price' => 449,
                            'discount_price' => null,
                            'stock' => 30,
                            'image' => 'uploads/products/1787742964_images_(6).jpg',
                            'is_featured' => 0,
                            'description' => 'Ergonomic brush that removes loose fur and detangles without pulling.',
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Cats',
            'description' => 'Comfort, treats and toys for curious cats.',
            'image' => 'uploads/categories/1789281184_images_(5).jpg',
            'subcategories' => [
                [
                    'name' => 'Toys',
                    'image' => 'uploads/subcategories/1784523553_cat_toys.jpg',
                    'products' => [
                        [
                            'name' => 'Rat Toys',
                            'price' => 800,
                            'discount_price' => 650,
                            'stock' => 150,
                            'image' => 'uploads/products/1787743224_images_(11).jpg',
                            'is_featured' => 1,
                            'description' => 'Safe and engaging toys designed to keep small pets active and stimulated.',
                        ],
                        [
                            'name' => 'Squeaky Bunny Toy',
                            'price' => 399,
                            'discount_price' => 299,
                            'stock' => 75,
                            'image' => 'uploads/products/1787743107_images_(9).jpg',
                            'is_featured' => 0,
                            'description' => 'Soft plush bunny with a built-in squeaker for playful pets.',
                        ],
                    ],
                ],
                [
                    'name' => 'Accessories',
                    'image' => 'uploads/products/1787743029_images_(7).jpg',
                    'products' => [
                        [
                            'name' => 'Cozy Pet Hoodie',
                            'price' => 2299,
                            'discount_price' => 1899,
                            'stock' => 18,
                            'image' => 'uploads/products/1787743029_images_(7).jpg',
                            'is_featured' => 0,
                            'description' => 'Fleece-lined winter hoodie with a comfortable stretch fit.',
                        ],
                        [
                            'name' => 'Cat Comfort Bed',
                            'price' => 1799,
                            'discount_price' => 1299,
                            'stock' => 12,
                            'image' => 'uploads/products/1787743072_images_(8).jpg',
                            'is_featured' => 1,
                            'description' => 'Plush donut bed with raised edges, washable cover and non-slip base.',
                        ],
                    ],
                ],
                [
                    'name' => 'Treats',
                    'image' => 'uploads/products/1787743166_images_(10).jpg',
                    'products' => [
                        [
                            'name' => 'Healthy Salmon Treats',
                            'price' => 599,
                            'discount_price' => 449,
                            'stock' => 90,
                            'image' => 'uploads/products/1787743166_images_(10).jpg',
                            'is_featured' => 0,
                            'description' => 'Grain-free training treats made from real salmon and omega-rich ingredients.',
                        ],
                    ],
                ],
            ],
        ],
    ];

    public function run(): void
    {
        $categoryCount = 0;
        $subcategoryCount = 0;
        $productCount = 0;

        foreach ($this->catalogue as $categoryData) {
            $category = $this->categoryByName($categoryData['name']);
            $category->fill([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
                'is_active' => 1,
                'deleted_at' => null,
            ]);
            $category->save();
            $categoryCount++;

            foreach ($categoryData['subcategories'] as $subcategoryData) {
                $subcategory = SubCategory::withTrashed()
                    ->where('category_id', $category->id)
                    ->whereRaw('LOWER(name) = ?', [Str::lower($subcategoryData['name'])])
                    ->first() ?? new SubCategory();

                $subcategory->fill([
                    'category_id' => $category->id,
                    'name' => $subcategoryData['name'],
                    'image' => $subcategoryData['image'],
                    'is_active' => 1,
                    'deleted_at' => null,
                ]);
                $subcategory->save();
                $subcategoryCount++;

                foreach ($subcategoryData['products'] as $productData) {
                    Product::withTrashed()->updateOrCreate(
                        ['name' => $productData['name']],
                        [
                            'subcategory_id' => $subcategory->id,
                            'price' => $productData['price'],
                            'discount_price' => $productData['discount_price'],
                            'stock' => $productData['stock'],
                            'image' => $productData['image'],
                            'description' => $productData['description'],
                            'status' => 1,
                            'is_featured' => $productData['is_featured'],
                            'deleted_at' => null,
                        ]
                    );
                    $productCount++;
                }
            }
        }

        $this->command?->info("Seeded {$categoryCount} categories, {$subcategoryCount} subcategories and {$productCount} products.");
    }

    private function categoryByName(string $name): Category
    {
        return Category::withTrashed()
            ->whereRaw('LOWER(name) = ?', [Str::lower($name)])
            ->orWhereRaw('LOWER(name) = ?', [Str::plural(Str::lower($name))])
            ->first() ?? new Category();
    }
}
