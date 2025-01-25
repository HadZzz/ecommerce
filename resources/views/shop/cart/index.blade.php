<x-app-layout>
    <!-- Cart Header -->
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
                    Your Shopping Cart
                </h1>
                <p class="mt-4 text-gray-500">
                    Review and modify your items before checkout
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(session()->has('cart') && count(session('cart')) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="divide-y divide-gray-200">
                            @foreach(session('cart') as $id => $details)
                                <div class="p-6 flex space-x-6">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0 w-24 h-24 bg-gray-200 rounded-lg overflow-hidden">
                                        <img src="{{ $details['image'] ?? 'https://via.placeholder.com/150' }}" 
                                             alt="{{ $details['name'] }}"
                                             class="w-full h-full object-center object-cover">
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    {{ $details['name'] }}
                                                </h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $details['category'] }}
                                                </p>
                                            </div>
                                            <div class="ml-4">
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center justify-between">
                                            <div class="flex items-center">
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <label for="quantity" class="sr-only">Quantity</label>
                                                    <select name="quantity" 
                                                            class="rounded-md border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                                            onchange="this.form.submit()">
                                                        @for($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ $details['quantity'] == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </form>
                                                <span class="text-gray-500 ml-4">×</span>
                                                <span class="ml-4 text-sm font-medium text-gray-900">
                                                    Rp {{ number_format($details['price'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <span class="text-base font-medium text-gray-900">
                                                    Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20">
                        <h2 class="text-lg font-medium text-gray-900">Order Summary</h2>
                        
                        <div class="mt-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">Subtotal</p>
                                <p class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">Shipping</p>
                                <p class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($shipping, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">Tax</p>
                                <p class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($tax, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-base font-medium text-gray-900">Order Total</p>
                                    <p class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($total + $shipping + $tax, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mt-6">
                            <form class="flex space-x-4">
                                <div class="flex-1">
                                    <label for="promo_code" class="sr-only">Promo Code</label>
                                    <input type="text" 
                                           id="promo_code" 
                                           name="promo_code" 
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm"
                                           placeholder="Enter promo code">
                                </div>
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-600 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Apply
                                </button>
                            </form>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('checkout') }}"
                               class="block w-full bg-red-500 border border-transparent rounded-md shadow-sm py-3 px-4 text-center text-base font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl text-gray-400 mb-4">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h2 class="text-2xl font-medium text-gray-900 mb-4">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-500 hover:bg-red-600">
                    <i class="fas fa-shopping-bag mr-2"></i> Continue Shopping
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
