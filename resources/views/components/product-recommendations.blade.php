@props(['productId'])

<div x-data="productRecommendations" x-init="fetchRecommendations({{ $productId }})" class="mt-12">
    <div class="flex items-center gap-3 mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Produk yang Mungkin Anda Suka</h2>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            AI Powered
        </span>
    </div>
    
    <div x-show="loading" class="flex justify-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900"></div>
    </div>

    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <template x-for="product in recommendations" :key="product.id">
            <div class="group relative bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <!-- Similarity Badge -->
                    <div class="absolute top-2 right-2 z-10">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
                              x-text="'Match: ' + Math.round(product.similarity * 100) + '%'">
                        </span>
                    </div>
                    
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden">
                        <img :src="product.image" :alt="product.name"
                            class="h-64 w-full object-cover object-center transform transition-transform duration-300 group-hover:scale-105">
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-900">
                            <a :href="'/products/' + product.id">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                <span x-text="product.name"></span>
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500" x-text="product.category"></p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-bold text-gray-900" x-text="formatPrice(product.price)"></p>
                        <button @click.prevent="addToCart(product.id)"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <div x-show="recommendations.length === 0 && !loading" 
             x-transition
             class="col-span-full text-center text-gray-500 py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada rekomendasi</h3>
            <p class="mt-1 text-sm text-gray-500">Belum ada produk yang cocok untuk direkomendasikan saat ini.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productRecommendations', () => ({
            recommendations: [],
            loading: true,

            async fetchRecommendations(productId) {
                this.loading = true;
                try {
                    const response = await fetch(`/api/products/${productId}/recommendations`);
                    const result = await response.json();
                    if (result.success) {
                        this.recommendations = result.data;
                    }
                } catch (error) {
                    console.error('Error fetching recommendations:', error);
                } finally {
                    this.loading = false;
                }
            },

            async addToCart(productId) {
                try {
                    const response = await fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    });

                    const result = await response.json();
                    if (result.success) {
                        // Show success notification
                        this.$dispatch('notify', {
                            type: 'success',
                            message: 'Product added to cart successfully!'
                        });
                        
                        // Update cart count in header (you'll need to implement this)
                        this.$dispatch('cart-updated');
                    }
                } catch (error) {
                    console.error('Error adding to cart:', error);
                    this.$dispatch('notify', {
                        type: 'error',
                        message: 'Failed to add product to cart.'
                    });
                }
            },

            formatPrice(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(price);
            }
        }));
    });
</script>
@endpush 