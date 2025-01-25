<x-app-layout>
    <!-- Order Details Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Order Details
                </h1>
                <p class="mt-3 text-xl text-blue-100">
                    Order #{{ $order->order_number }}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Order Information -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Order Status -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-900">Order Status</h2>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $order->status === 'success' ? 'bg-green-100 text-green-800' :
                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   'bg-red-100 text-red-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @if($order->items && $order->items->count() > 0)
                                @foreach($order->items as $item)
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ $item->product->image }}"
                                                     alt="{{ $item->product->name }}"
                                                     class="w-full h-full object-center object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">
                                                {{ $item->product ? $item->product->name : 'Product Not Found' }}
                                            </h4>
                                            <div class="mt-1 flex justify-between">
                                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                                <p class="text-sm font-medium text-gray-900">
                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <p class="text-gray-500">No items found in this order.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Order Date</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $order->created_at->format('M d, Y H:i') }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Payment Method</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ ucfirst($order->payment_method) }}
                                </dd>
                            </div>
                            <div class="pt-3 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <dt class="text-base font-medium text-gray-900">Total Amount</dt>
                                    <dd class="text-base font-medium text-blue-600">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </dd>
                                </div>
                            </div>
                        </dl>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Information</h3>
                        <p class="text-sm text-gray-600">
                            {{ $order->shipping_address }}
                        </p>
                    </div>

                    @if($order->notes)
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Notes</h3>
                            <p class="text-sm text-gray-600">
                                {{ $order->notes }}
                            </p>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-6">
                        <a href="{{ route('orders.index') }}" 
                           class="block w-full bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors text-center">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 