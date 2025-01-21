<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'is_active' => true,
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'is_active' => true,
            ],
            [
                'name' => 'Home & Living',
                'slug' => 'home-living',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Smartphone X',
                'slug' => 'smartphone-x',
                'description' => 'Latest smartphone with amazing features',
                'price' => 5999000,
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Laptop Pro',
                'slug' => 'laptop-pro',
                'description' => 'Professional laptop for work and gaming',
                'price' => 12999000,
                'stock' => 5,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Casual T-Shirt',
                'slug' => 'casual-t-shirt',
                'description' => 'Comfortable cotton t-shirt',
                'price' => 199000,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Denim Jeans',
                'slug' => 'denim-jeans',
                'description' => 'Classic denim jeans',
                'price' => 499000,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Coffee Table',
                'slug' => 'coffee-table',
                'description' => 'Modern coffee table for your living room',
                'price' => 1499000,
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Bed Sheet Set',
                'slug' => 'bed-sheet-set',
                'description' => 'Premium cotton bed sheet set',
                'price' => 299000,
                'stock' => 20,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
