<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent($order)
    {
        return PaymentIntent::create([
            'amount' => $order->total_amount * 100, // Convert to cents
            'currency' => 'usd',
            'metadata' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number
            ],
        ]);
    }

    public function handleWebhook($payload)
    {
        $event = \Stripe\Event::constructFrom($payload);

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $order = Order::where('id', $paymentIntent->metadata->order_id)->first();
                if ($order) {
                    $order->update(['status' => 'paid']);
                }
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $order = Order::where('id', $paymentIntent->metadata->order_id)->first();
                if ($order) {
                    $order->update(['status' => 'failed']);
                }
                break;
        }

        return response()->json(['status' => 'success']);
    }
} 