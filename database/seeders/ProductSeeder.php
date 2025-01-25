<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Smartphones
            [
                'category' => 'Smartphones',
                'products' => [
                    [
                        'name' => 'iPhone 15 Pro',
                        'price' => 15999000,
                        'description' => 'Latest iPhone with A17 Pro chip, 48MP camera system, and titanium design.',
                        'stock' => 50
                    ],
                    [
                        'name' => 'Samsung Galaxy S23 Ultra',
                        'price' => 14999000,
                        'description' => 'Flagship Android phone with S Pen, 200MP camera, and powerful Snapdragon processor.',
                        'stock' => 45
                    ],
                    [
                        'name' => 'Google Pixel 8 Pro',
                        'price' => 13999000,
                        'description' => 'Pure Android experience with exceptional camera capabilities and AI features.',
                        'stock' => 30
                    ],
                    [
                        'name' => 'OnePlus 11',
                        'price' => 9999000,
                        'description' => 'Fast and smooth performance with Hasselblad camera system.',
                        'stock' => 40
                    ],
                    [
                        'name' => 'Xiaomi 13 Pro',
                        'price' => 11999000,
                        'description' => 'Premium smartphone with Leica optics and fast charging.',
                        'stock' => 35
                    ]
                ]
            ],
            // Laptops
            [
                'category' => 'Laptops',
                'products' => [
                    [
                        'name' => 'MacBook Pro 16"',
                        'price' => 25999000,
                        'description' => 'Powerful laptop with M2 Pro chip, stunning display, and long battery life.',
                        'stock' => 25
                    ],
                    [
                        'name' => 'Dell XPS 15',
                        'price' => 19999000,
                        'description' => 'Premium Windows laptop with InfinityEdge display and strong performance.',
                        'stock' => 30
                    ],
                    [
                        'name' => 'Lenovo ThinkPad X1 Carbon',
                        'price' => 18999000,
                        'description' => 'Business laptop with excellent keyboard and build quality.',
                        'stock' => 20
                    ],
                    [
                        'name' => 'ASUS ROG Zephyrus G14',
                        'price' => 16999000,
                        'description' => 'Compact gaming laptop with powerful AMD processor.',
                        'stock' => 25
                    ],
                    [
                        'name' => 'HP Spectre x360',
                        'price' => 17999000,
                        'description' => 'Versatile 2-in-1 laptop with premium design and features.',
                        'stock' => 20
                    ]
                ]
            ],
            // Tablets
            [
                'category' => 'Tablets',
                'products' => [
                    [
                        'name' => 'iPad Pro 12.9"',
                        'price' => 15999000,
                        'description' => 'Powerful tablet with M2 chip and mini-LED display.',
                        'stock' => 30
                    ],
                    [
                        'name' => 'Samsung Galaxy Tab S9 Ultra',
                        'price' => 14999000,
                        'description' => 'Large Android tablet with S Pen and productivity features.',
                        'stock' => 25
                    ],
                    [
                        'name' => 'Microsoft Surface Pro 9',
                        'price' => 16999000,
                        'description' => 'Versatile Windows tablet with laptop capabilities.',
                        'stock' => 20
                    ],
                    [
                        'name' => 'iPad Air',
                        'price' => 9999000,
                        'description' => 'Mid-range tablet with M1 chip and great performance.',
                        'stock' => 35
                    ],
                    [
                        'name' => 'Lenovo Tab P12 Pro',
                        'price' => 8999000,
                        'description' => 'Premium Android tablet with OLED display.',
                        'stock' => 25
                    ]
                ]
            ],
            // Accessories
            [
                'category' => 'Accessories',
                'products' => [
                    [
                        'name' => 'AirPods Pro 2',
                        'price' => 3999000,
                        'description' => 'Wireless earbuds with active noise cancellation.',
                        'stock' => 100
                    ],
                    [
                        'name' => 'Samsung Galaxy Watch 6',
                        'price' => 4999000,
                        'description' => 'Advanced smartwatch with health tracking features.',
                        'stock' => 75
                    ],
                    [
                        'name' => 'Apple Watch Series 9',
                        'price' => 5999000,
                        'description' => 'Latest Apple Watch with new features and sensors.',
                        'stock' => 80
                    ],
                    [
                        'name' => 'Sony WH-1000XM5',
                        'price' => 4499000,
                        'description' => 'Premium noise-cancelling headphones.',
                        'stock' => 60
                    ],
                    [
                        'name' => 'Apple Magic Keyboard',
                        'price' => 1999000,
                        'description' => 'Wireless keyboard with great typing experience.',
                        'stock' => 50
                    ]
                ]
            ],
            // Smart Home
            [
                'category' => 'Smart Home',
                'products' => [
                    [
                        'name' => 'Amazon Echo Show 10',
                        'price' => 3499000,
                        'description' => 'Smart display with motion tracking and Alexa.',
                        'stock' => 40
                    ],
                    [
                        'name' => 'Google Nest Hub Max',
                        'price' => 2999000,
                        'description' => 'Smart display with Google Assistant and camera.',
                        'stock' => 35
                    ],
                    [
                        'name' => 'Philips Hue Starter Kit',
                        'price' => 1999000,
                        'description' => 'Smart lighting system with bridge and bulbs.',
                        'stock' => 45
                    ],
                    [
                        'name' => 'Ring Video Doorbell Pro',
                        'price' => 2499000,
                        'description' => 'Smart doorbell with HD video and two-way talk.',
                        'stock' => 30
                    ],
                    [
                        'name' => 'Arlo Pro 4 Camera System',
                        'price' => 4999000,
                        'description' => 'Wireless security cameras with 2K HDR.',
                        'stock' => 25
                    ]
                ]
            ]
        ];

        foreach ($products as $categoryData) {
            $category = Category::where('name', $categoryData['category'])->first();
            
            if ($category) {
                foreach ($categoryData['products'] as $productData) {
                    Product::create([
                        'category_id' => $category->id,
                        'name' => $productData['name'],
                        'slug' => Str::slug($productData['name']),
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'stock' => $productData['stock']
                    ]);
                }
            }
        }
    }
}
