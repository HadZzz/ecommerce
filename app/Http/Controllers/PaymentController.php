<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\StripeService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function process($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        try {
            $paymentIntent = $this->stripeService->createPaymentIntent($order);
            
            return view('shop.payment', [
                'order' => $order,
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function webhook(Request $request)
    {
        try {
            return $this->stripeService->handleWebhook($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function success(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->firstOrFail();
        
        // Update order status to paid
        $order->update(['status' => 'paid']);
        
        return view('shop.payment-success', compact('order'));
    }

    public function cancel(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->firstOrFail();
        
        // Update order status to cancelled
        $order->update(['status' => 'cancelled']);
        
        return redirect()->route('checkout.success', $order->order_number)
            ->with('error', 'Payment was cancelled.');
    }
} 