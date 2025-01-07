<x-app-layout>
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
                                <input type="number" name="min_price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Max Price</label>
                                <input type="number" name="max_price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
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
                    <div class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Product Image -->
                        <div class="relative aspect-w-1 aspect-h-1 bg-gray-200">
                            <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-center object-cover group-hover:opacity-75">
                            @if($product->is_featured)
                                <div class="absolute top-0 right-0 mt-2 mr-2 px-2 py-1 bg-red-500 text-white text-xs font-bold rounded">
                                    Featured
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mb-4">{{ Str::limit($product->description, 100) }}</p>
                            
                            <!-- Category -->
                            <div class="mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <!-- Price and Cart -->
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-shrink-0 cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-cart-plus mr-2"></i> Add to Cart
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
</x-app-layout>

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
