<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);
        
        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->paginate(12);
        $categories = Category::where('is_active', true)->withCount('products')->get();
        
        return view('shop.products.index', compact('products', 'categories'));
    }
    
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
            
        return view('shop.products.show', compact('product', 'relatedProducts'));
    }
}
