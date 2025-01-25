<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Smartphones' => [
                'description' => 'Latest smartphones from various brands',
                'icon' => 'phone'
            ],
            'Laptops' => [
                'description' => 'Powerful laptops for work and gaming',
                'icon' => 'laptop'
            ],
            'Tablets' => [
                'description' => 'Tablets and 2-in-1 devices',
                'icon' => 'tablet'
            ],
            'Accessories' => [
                'description' => 'Essential accessories for your devices',
                'icon' => 'headphones'
            ],
            'Smart Home' => [
                'description' => 'Smart home devices and automation',
                'icon' => 'home'
            ]
        ];

        foreach ($categories as $name => $details) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $details['description'],
                'icon' => $details['icon']
            ]);
        }
    }
}
