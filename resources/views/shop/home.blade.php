@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Discover Amazing</span>
                            <span class="block text-red-500 xl:inline">Products</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Find the best products from our curated collection. Quality meets affordability.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-500 hover:bg-red-600 md:py-4 md:text-lg md:px-10">
                                    <i class="fas fa-shopping-cart mr-2"></i> Shop Now
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#categories" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-red-600 bg-red-100 hover:bg-red-200 md:py-4 md:text-lg md:px-10">
                                    <i class="fas fa-th-large mr-2"></i> Categories
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Shopping">
        </div>
    </div>

    <!-- Featured Categories -->
    <div id="categories" class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Shop by Category</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">Choose from our wide range of categories</p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($categories as $category)
                <div class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 transition-opacity duration-300">
                        <img src="{{ $category->image_url ?? 'https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80' }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-full object-center object-cover">
                    </div>
                    <div class="px-6 py-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ $category->description }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">
                                {{ $category->products_count }} Products
                            </span>
                            <a href="/category/{{ $category->slug }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-red-600 bg-red-100 hover:bg-red-200">
                                View All <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Featured Products</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">Check out our latest and most popular items</p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredProducts as $product)
                <div class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="relative w-full h-64 bg-white rounded-t-lg overflow-hidden group-hover:opacity-75 transition-opacity duration-300">
                        <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-center object-cover">
                        @if($product->is_featured)
                            <div class="absolute top-0 right-0 mt-2 mr-2 px-2 py-1 bg-red-500 text-white text-xs font-bold rounded">
                                Featured
                            </div>
                        @endif
                    </div>
                    <div class="px-6 py-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" class="cart-form">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600">
                                    <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-500 hover:bg-red-600">
                    View All Products <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Free Shipping -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <div class="text-red-500 text-3xl mb-4">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Free Shipping</h3>
                    <p class="text-gray-500 text-sm">On orders over Rp 500.000</p>
                </div>

                <!-- Secure Payment -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <div class="text-red-500 text-3xl mb-4">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure Payment</h3>
                    <p class="text-gray-500 text-sm">100% secure payment</p>
                </div>

                <!-- 24/7 Support -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <div class="text-red-500 text-3xl mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-500 text-sm">Dedicated support</p>
                </div>

                <!-- Money Back -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <div class="text-red-500 text-3xl mb-4">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Money Back</h3>
                    <p class="text-gray-500 text-sm">30 days guarantee</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-red-500 rounded-2xl shadow-xl overflow-hidden">
                <div class="px-6 py-12 sm:px-12 lg:px-16">
                    <div class="max-w-3xl mx-auto text-center">
                        <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                            Subscribe to Our Newsletter
                        </h2>
                        <p class="mt-4 text-lg leading-6 text-red-100">
                            Stay up to date with the latest products, exclusive offers, and shopping tips.
                        </p>
                        <form class="mt-8 sm:flex justify-center">
                            <div class="min-w-0 flex-1">
                                <label for="email" class="sr-only">Email address</label>
                                <input id="email" type="email" placeholder="Enter your email" class="block w-full px-4 py-3 text-base text-gray-900 placeholder-gray-500 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-red-500">
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-3">
                                <button type="submit" class="block w-full px-4 py-3 font-medium text-red-500 bg-white border border-transparent rounded-md shadow hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-red-500 sm:px-8">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(Object.fromEntries(new FormData(this)))
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update cart count in navigation if needed
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cartCount;
                }
            }
        });
    });
});
</script>
@endpush
