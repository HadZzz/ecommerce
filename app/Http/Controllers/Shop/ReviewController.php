<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000'
        ]);

        // Check if user has purchased the product
        $hasOrdered = $product->orderItems()
            ->whereHas('order', function ($query) {
                $query->where('user_id', auth()->id())
                    ->where('status', 'completed');
            })->exists();

        // Create or update review
        $review = Review::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'verified_purchase' => $hasOrdered
            ]
        );

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully!',
                'review' => $review->load('user'),
                'averageRating' => $product->average_rating,
                'reviewsCount' => $product->reviews_count
            ]);
        }

        return back()->with('success', 'Review submitted successfully!');
    }

    public function destroy(Product $product)
    {
        $review = $product->reviews()
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}
