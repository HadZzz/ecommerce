<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Cart;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.is_production');
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;
    }

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
            'payment_method' => 'required',
        ]);
        
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => Cart::getTotal(),
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
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

        // Handle payment based on method
        if ($request->payment_method === 'midtrans') {
            $payload = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                'item_details' => Cart::getContent()->map(function($item) {
                    return [
                        'id' => $item->id,
                        'price' => (int) $item->price,
                        'quantity' => $item->quantity,
                        'name' => $item->name,
                    ];
                })->values()->toArray(),
            ];

            try {
                // Get Snap Payment Page URL
                $snapToken = Snap::getSnapToken($payload);
                
                // Update order with snap token
                $order->update(['snap_token' => $snapToken]);
                
                // Clear cart
                Cart::clear();
                
                return view('shop.payment', compact('snapToken', 'order'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Payment error: ' . $e->getMessage());
            }
        }
        
        // For other payment methods (like bank transfer)
        Cart::clear();
        return redirect()->route('checkout.success', $order->order_number);
    }
    
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('shop.checkout-success', compact('order'));
    }

    public function notification(Request $request)
    {
        $notif = new \Midtrans\Notification();
        
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        $order = Order::where('order_number', $orderId)->firstOrFail();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $order->setStatusPending();
                } else {
                    $order->setStatusSuccess();
                }
            }
        } else if ($transaction == 'settlement') {
            $order->setStatusSuccess();
        } else if ($transaction == 'pending') {
            $order->setStatusPending();
        } else if ($transaction == 'deny') {
            $order->setStatusFailed();
        } else if ($transaction == 'expire') {
            $order->setStatusExpired();
        } else if ($transaction == 'cancel') {
            $order->setStatusFailed();
        }

        return response()->json(['status' => 'success']);
    }
}
