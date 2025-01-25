<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with(['product' => function($query) {
                $query->with('media');
            }])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shop.wishlist', ['wishlistItems' => $wishlistItems]);
    }

    public function toggle(Product $product)
    {
        $wishlistItem = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $message = 'Product removed from wishlist';
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id
            ]);
            $message = 'Product added to wishlist';
        }

        return back()->with('success', $message);
    }
}
