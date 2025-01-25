@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-6">My Orders</h2>

                @if($orders->isEmpty())
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-bag text-gray-400 text-5xl mb-4"></i>
                        <p class="text-gray-500">You haven't placed any orders yet.</p>
                        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                            Start Shopping
                        </a>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="border rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b flex justify-between items-center">
                                    <div>
                                        <span class="text-sm text-gray-600">Order #{{ $order->order_number }}</span>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-lg font-semibold text-gray-900">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </span>
                                        <p class="text-sm px-3 py-1 rounded-full 
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->status === 'completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-4">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-16 h-16">
                                                    @if($item->product && $item->product->getFirstMediaUrl('images'))
                                                        <img src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                             alt="{{ $item->product_name }}"
                                                             class="w-full h-full object-cover rounded">
                                                    @else
                                                        <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                            <i class="fas fa-image text-gray-400"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="text-sm font-medium text-gray-900">
                                                        {{ $item->product_name }}
                                                    </h3>
                                                    <p class="text-sm text-gray-500">
                                                        Quantity: {{ $item->quantity }} × 
                                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 border-t">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                Shipping Address:
                                            </p>
                                            <p class="text-sm text-gray-900">
                                                {{ $order->shipping_address }}
                                            </p>
                                        </div>
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            View Details
                                            <i class="fas fa-chevron-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection