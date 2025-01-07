<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        return view('shop.cart', compact('cartItems'));
    }
    
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity ?? 1,
            'attributes' => [
                'image' => $product->getFirstMediaUrl('images') ?: null,
                'category' => $product->category->name ?? 'Uncategorized'
            ]
        ]);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cartCount' => Cart::getContent()->count()
            ]);
        }
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function update(Request $request)
    {
        Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);
        
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
    
    public function remove($id)
    {
        Cart::remove($id);
        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }
    
    public function clear()
    {
        Cart::clear();
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
