<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $products = Product::take(3)->get();

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => 0,
            'status' => 'processing',
            'payment_method' => 'bank_transfer',
            'shipping_address' => 'Jl. Test No. 123',
            'notes' => 'Test order'
        ]);

        $total = 0;
        foreach ($products as $product) {
            $quantity = rand(1, 3);
            $price = $product->price;
            $subtotal = $price * $quantity;
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal
            ]);
        }

        $order->update(['total_amount' => $total]);
    }
}
