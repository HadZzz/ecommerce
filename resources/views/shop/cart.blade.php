<x-app-layout>
    <!-- Cart Header -->
    <div class="bg-gradient-to-r from-red-500 to-red-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Your Shopping Cart
                </h1>
                <p class="mt-3 text-xl text-red-100">
                    Review your items and proceed to checkout
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($cartItems->count() > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <li class="p-6 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex items-center space-x-6">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-32 h-32 rounded-lg overflow-hidden">
                                            @if(isset($item->attributes['image']))
                                                <img src="{{ $item->attributes['image'] }}" 
                                                     alt="{{ $item->name }}"
                                                     class="w-full h-full object-center object-cover">
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-900">
                                                        {{ $item->name }}
                                                    </h3>
                                                    @if(isset($item->attributes['category']))
                                                    <p class="mt-1.5 text-sm text-gray-500">
                                                        {{ $item->attributes['category'] }}
                                                    </p>
                                                    @endif
                                                    <div class="mt-2">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            In Stock
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500 transition-colors">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="mt-4 flex items-center justify-between">
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-3">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <label for="quantity" class="text-sm font-medium text-gray-700">
                                                        Quantity
                                                    </label>
                                                    <select name="quantity" 
                                                            onchange="this.form.submit()"
                                                            class="rounded-md border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                                        @for($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </form>
                                                <div class="flex items-center space-x-4">
                                                    <span class="text-sm text-gray-500">Price per item:</span>
                                                    <span class="text-lg font-medium text-gray-900">
                                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="text-lg font-bold text-gray-900">
                                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Cart Actions -->
                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Continue Shopping
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700">
                                <i class="fas fa-trash mr-2"></i>
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-20">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="flow-root">
                            <dl class="-my-4 text-sm divide-y divide-gray-200">
                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-gray-600">Subtotal</dt>
                                    <dd class="font-medium text-gray-900">
                                        Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}
                                    </dd>
                                </div>

                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-gray-600">Shipping</dt>
                                    <dd class="font-medium text-gray-900">Free</dd>
                                </div>

                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-gray-600">Tax</dt>
                                    <dd class="font-medium text-gray-900">
                                        Rp {{ number_format(Cart::getTotal() * 0.1, 0, ',', '.') }}
                                    </dd>
                                </div>

                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-base font-bold text-gray-900">Order Total</dt>
                                    <dd class="text-xl font-bold text-red-600">
                                        Rp {{ number_format(Cart::getTotal() * 1.1, 0, ',', '.') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Promo Code -->
                        <div class="mt-8">
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
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-600 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Apply
                                </button>
                            </form>
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('checkout.index') }}"
                               class="block w-full bg-red-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-center text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                Proceed to Checkout
                            </a>
                        </div>

                        <!-- Secure Checkout -->
                        <div class="mt-8">
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
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16 bg-white rounded-xl shadow-lg">
                <div class="mb-6">
                    <div class="mx-auto h-24 w-24 text-red-500">
                        <i class="fas fa-shopping-cart text-6xl"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
