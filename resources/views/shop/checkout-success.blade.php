<x-app-layout>
    <!-- Success Header -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-6">
                    <i class="fas fa-check-circle text-white text-6xl"></i>
                </div>
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Order Successful!
                </h1>
                <p class="mt-3 text-xl text-green-100">
                    Thank you for your purchase. Your order has been received.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Order Information -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Order Details</h2>
                    <p class="mt-2 text-gray-600">Order Number: {{ $order->order_number }}</p>
                </div>

                <!-- Order Status Timeline -->
                <div class="max-w-3xl mx-auto mb-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-between">
                            <div>
                                <span class="bg-green-500 h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </span>
                                <p class="mt-2 text-sm text-gray-500">Order Placed</p>
                            </div>
                            <div>
                                <span class="bg-gray-200 h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white">
                                    <i class="fas fa-box text-gray-600 text-sm"></i>
                                </span>
                                <p class="mt-2 text-sm text-gray-500">Processing</p>
                            </div>
                            <div>
                                <span class="bg-gray-200 h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white">
                                    <i class="fas fa-shipping-fast text-gray-600 text-sm"></i>
                                </span>
                                <p class="mt-2 text-sm text-gray-500">Shipped</p>
                            </div>
                            <div>
                                <span class="bg-gray-200 h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white">
                                    <i class="fas fa-home text-gray-600 text-sm"></i>
                                </span>
                                <p class="mt-2 text-sm text-gray-500">Delivered</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden bg-gray-100">
                                    @if($item->product && $item->product->getFirstMediaUrl('images'))
                                        <img src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                             alt="{{ $item->product->name }}"
                                             class="w-full h-full object-center object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <p class="text-sm font-medium text-gray-900">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm mt-2">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-gray-900">Free</span>
                        </div>
                        <div class="flex justify-between text-base font-medium mt-4">
                            <span class="text-gray-900">Total</span>
                            <span class="text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600 whitespace-pre-line">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600">
                                <span class="font-medium">Payment Method:</span> 
                                {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}
                            </p>
                            @if($order->payment_method === 'bank_transfer')
                            <div class="mt-4">
                                <p class="text-sm text-gray-500">Please transfer to:</p>
                                <div class="mt-2 p-3 bg-white rounded-md border border-gray-200">
                                    <p class="font-medium text-gray-900">Bank Central Asia (BCA)</p>
                                    <p class="text-gray-600">Account: 1234567890</p>
                                    <p class="text-gray-600">Name: Your Store Name</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors">
                        <i class="fas fa-home mr-2"></i> Back to Home
                    </a>
                    <a href="#" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fas fa-file-alt mr-2"></i> Download Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
