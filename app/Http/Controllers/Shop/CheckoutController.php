<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;
        
        foreach($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        
        return view('shop.checkout', compact('cartItems', 'total'));
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required|in:stripe,bank_transfer,cash_on_delivery',
        ]);

        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Calculate total
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Set status berdasarkan metode pembayaran
        $status = 'pending';
        if ($request->payment_method === 'cash_on_delivery') {
            $status = 'success'; // COD langsung success
        } elseif ($request->payment_method === 'bank_transfer') {
            $status = 'pending'; // Bank transfer menunggu konfirmasi
        }
        
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'status' => $status
        ]);
        
        // Create order items
        foreach ($cartItems as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $subtotal
            ]);
        }

        // Clear cart
        session()->forget('cart');
        
        // Redirect based on payment method
        if ($request->payment_method === 'stripe') {
            return redirect()->route('payment.process', $order);
        }
        
        return redirect()->route('checkout.success', $order->order_number)
            ->with('success', 'Order placed successfully!');
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('shop.checkout-success', compact('order'));
    }
}
