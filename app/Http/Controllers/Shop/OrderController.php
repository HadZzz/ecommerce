<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $query = Order::where('user_id', auth()->id())
                     ->latest();
        
        // Filter by status if provided
        if ($status) {
            $query->where('status', $status);
        }
        
        $orders = $query->paginate(10);
        
        return view('shop.orders.index', [
            'orders' => $orders,
            'currentStatus' => $status
        ]);
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Eager load relationships
        $order->load(['items.product', 'user']);

        return view('shop.orders.show', compact('order'));
    }
} 