@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                Our Products
            </h1>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Browse our collection of quality products at amazing prices
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="w-full lg:w-1/4">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Filters</h2>
                
                <!-- Categories -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                   class="rounded border-gray-300 text-red-500 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-600">
                                {{ $category->name }}
                                <span class="text-gray-400">({{ $category->products_count }})</span>
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Price Range</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="text-sm text-gray-600">Min Price</label>
                            <input type="number" name="min_price" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Max Price</label>
                            <input type="number" name="max_price" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Sort By -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Sort By</h3>
                    <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                        <option value="newest">Newest First</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="name_asc">Name: A to Z</option>
                        <option value="name_desc">Name: Z to A</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="w-full lg:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="group relative bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="relative aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-t-lg bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            @if($product->getFirstMediaUrl('images'))
                                <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                     alt="{{ $product->name }}"
                                     class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                            @else
                                <img src="https://placehold.co/800x600/EEE/31343C?font=montserrat&text={{ urlencode($product->name) }}"
                                     alt="{{ $product->name }}"
                                     class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                            @endif
                            @auth
                                <form action="{{ route('wishlist.toggle', $product) }}" method="POST" 
                                      class="absolute top-2 right-2 z-10">
                                    @csrf
                                    <button type="submit" 
                                            class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-md hover:shadow-lg transform hover:scale-110 transition-all duration-300 group">
                                        @php
                                            $isInWishlist = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
                                        @endphp
                                        <i class="fas fa-heart text-xl transition-colors duration-300
                                            {{ $isInWishlist ? 'text-red-500' : 'text-gray-400 group-hover:text-red-500' }}"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <div class="p-4">
                            <div class="mb-2">
                                <p class="text-sm text-red-600 font-medium mb-1">{{ $product->category->name }}</p>
                                <h3 class="text-base font-medium text-gray-900 line-clamp-2">
                                    <a href="{{ route('products.show', $product) }}" class="hover:text-red-600 transition-colors">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" 
                                            class="flex items-center justify-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                        <i class="fas fa-cart-plus mr-2"></i>
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
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
