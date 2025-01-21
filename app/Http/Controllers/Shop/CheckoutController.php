<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index');
        }
        
        $cartItems = Cart::getContent();
        return view('shop.checkout', compact('cartItems'));
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required|in:stripe,bank_transfer,cash_on_delivery',
        ]);

        // Set default payment method to stripe if not specified
        $paymentMethod = $request->payment_method ?? 'stripe';
        
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => Cart::getTotal(),
            'shipping_address' => $request->shipping_address,
            'payment_method' => $paymentMethod,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);
        
        // Create order items
        foreach (Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->getPriceSum(),
            ]);
        }

        // Clear cart
        Cart::clear();
        
        // Always redirect to payment page for stripe payment
        if ($paymentMethod === 'stripe') {
            return redirect()->route('payment.process', $order->id);
        }
        
        // For other payment methods, redirect to success page
        return redirect()->route('checkout.success', $order->order_number)
            ->with('success', 'Order placed successfully!');
    }
    
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('shop.checkout-success', compact('order'));
    }
}
