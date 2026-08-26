<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Catalogue data for the storefront.
     *
     * Subcategories are keyed by name and attached to an existing category.
     * Products are keyed by name so the seeder can be re-run without
     * creating duplicates — re-running refreshes prices and stock instead.
     */
    protected array $subcategories = [
        'Healthcare' => 'Dog',
        'Grooming' => 'Dog',
        'Accessories' => 'cats',
        'Treats' => 'cats',
    ];

    protected array $products = [
        // [name, subcategory, price, discount_price, stock, is_featured, description]
        ['Premium Puppy Food', 'Food', 1199, 899, 40, 0, 'Complete nutrition for growing puppies, packed with protein, calcium and omega-3 for healthy bones and a shiny coat.'],
        ['Chicken & Rice Adult Dog Food', 'Food', 1499, 1249, 45, 0, 'Everyday wholegrain meal for adult dogs, made with real chicken and easily digestible rice.'],
        ['Dental Care Chew Sticks', 'Healthcare', 499, 349, 60, 1, 'Vet-approved chew sticks that reduce tartar build-up and freshen breath while your pet plays.'],
        ['Pet First Aid Kit', 'Healthcare', 999, 799, 25, 0, 'Compact travel kit with bandages, antiseptic wipes, tweezers and a tick remover for everyday emergencies.'],
        ['Lavender Grooming Shampoo', 'Grooming', 699, 549, 32, 0, 'Gentle, tear-free shampoo with lavender and aloe vera that soothes sensitive skin and leaves a soft finish.'],
        ['Soft Bristle Grooming Brush', 'Grooming', 449, null, 0, 0, 'Ergonomic brush with soft bristles that removes loose fur and detangles without pulling.'],
        ['Cozy Pet Hoodie', 'Accessories', 2299, 1899, 18, 0, 'Fleece-lined winter hoodie with a stretch fit, keeping small and medium pets warm on cold mornings.'],
        ['Cat Comfort Bed', 'Accessories', 1799, 1299, 12, 1, 'Plush donut bed with raised edges for head support, machine washable and non-slip underneath.'],
        ['Squeaky Bunny Toy', 'toys', 399, 299, 75, 0, 'Soft plush bunny with a built-in squeaker that keeps playful pets entertained for hours.'],
        ['Healthy Salmon Treats', 'Treats', 599, 449, 90, 0, 'Grain-free training treats made from real salmon, rich in omega-3 and free from artificial colours.'],
    ];

    public function run(): void
    {
        foreach ($this->subcategories as $name => $categoryName) {
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['is_active' => 1]
            );

            SubCategory::updateOrCreate(
                ['name' => $name],
                ['category_id' => $category->id, 'is_active' => 1]
            );
        }

        foreach ($this->products as [$name, $subcategoryName, $price, $discountPrice, $stock, $isFeatured, $description]) {
            $subcategory = SubCategory::where('name', $subcategoryName)->first();

            if (! $subcategory) {
                $this->command?->warn("Skipping [{$name}] — subcategory [{$subcategoryName}] not found.");

                continue;
            }

            Product::updateOrCreate(
                ['name' => $name],
                [
                    'subcategory_id' => $subcategory->id,
                    'price' => $price,
                    'discount_price' => $discountPrice,
                    'stock' => $stock,
                    'description' => $description,
                    'status' => 1,
                    'is_featured' => $isFeatured,
                ]
            );
        }

        $this->command?->info('Seeded '.count($this->products).' products across '.SubCategory::count().' subcategories.');
    }
}
