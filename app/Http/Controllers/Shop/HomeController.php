<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();
            
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('shop.home', compact('featuredProducts', 'categories'));
    }
}
