@extends('layouts.app')

@section('content')
    <!-- Checkout Header -->
    <div class="bg-gradient-to-r from-red-500 to-red-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Checkout
                </h1>
                <p class="mt-3 text-xl text-red-100">
                    Complete your order
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Shipping Information</h2>
                    
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <!-- Shipping Address -->
                        <div class="mb-6">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Shipping Address
                            </label>
                            <textarea id="shipping_address" 
                                    name="shipping_address" 
                                    rows="3" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                    required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Payment Method
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="stripe"
                                           class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300"
                                           checked>
                                    <span class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">Credit Card (Stripe)</span>
                                        <span class="block text-sm text-gray-500">Pay securely with credit card</span>
                                    </span>
                                </label>

                                <label class="flex items-center">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="bank_transfer"
                                           class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300">
                                    <span class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">Bank Transfer</span>
                                        <span class="block text-sm text-gray-500">Pay via bank transfer</span>
                                    </span>
                                </label>

                                <label class="flex items-center">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="cash_on_delivery"
                                           class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300">
                                    <span class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">Cash on Delivery</span>
                                        <span class="block text-sm text-gray-500">Pay when you receive</span>
                                    </span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order Notes -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Order Notes (Optional)
                            </label>
                            <textarea id="notes" 
                                    name="notes" 
                                    rows="2" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                    placeholder="Any special instructions for your order?">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" 
                                class="w-full bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors">
                            Place Order
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-20">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $id => $item)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-100">
                                    @if(isset($item['image']))
                                        <img src="{{ $item['image'] }}" 
                                             alt="{{ $item['name'] }}"
                                             class="w-full h-full object-center object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900">
                                        {{ $item['name'] }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Qty: {{ $item['quantity'] }}
                                    </p>
                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Price Summary -->
                    <div class="border-t border-gray-200 pt-4 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-gray-900">Free</span>
                        </div>
                        <div class="flex justify-between text-base font-medium">
                            <span class="text-gray-900">Total</span>
                            <span class="text-red-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-lock text-green-500 mr-2"></i>
                                Secure Checkout
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-truck text-blue-500 mr-2"></i>
                                Free Shipping
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggleBankOptions(show) {
        const bankOptions = document.getElementById('bankOptions');
        bankOptions.style.display = show ? 'block' : 'none';
        
        // Disable bank_type inputs when hidden
        const bankInputs = bankOptions.querySelectorAll('input[name="bank_type"]');
        bankInputs.forEach(input => {
            input.disabled = !show;
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const bankTransferRadio = document.querySelector('input[name="payment_method"][value="bank_transfer"]');
        toggleBankOptions(bankTransferRadio.checked);
    });
</script>
