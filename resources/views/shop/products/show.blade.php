@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-3 text-sm mb-8">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-red-600">Home</a>
        <span class="text-gray-400">/</span>
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-red-600">Products</a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-7 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16">
        <!-- Product gallery -->
        <div class="lg:col-span-4">
            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100">
                @if($product->getFirstMediaUrl('images'))
                    <img src="{{ $product->getFirstMediaUrl('images') }}" 
                         alt="{{ $product->name }}"
                         class="h-full w-full object-cover object-center">
                @else
                    <div class="flex h-full items-center justify-center bg-gray-100">
                        <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product details -->
        <div class="mx-auto mt-14 max-w-2xl sm:mt-16 lg:col-span-3 lg:mt-0">
            <div class="lg:border-l lg:border-gray-200 lg:pl-8">
                <div class="pb-6">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->name }}</h1>
                    
                    <div class="mt-4 flex items-center">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="ml-2 text-sm text-gray-500">24 reviews</p>
                        </div>
                        <div class="ml-4 flex">
                            <span class="inline-flex items-center gap-x-1.5 rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                                <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6">
                                    <circle cx="3" cy="3" r="3" />
                                </svg>
                                {{ $product->category->name }}
                            </span>
                            @if($product->stock > 0)
                                <span class="ml-2 inline-flex items-center gap-x-1.5 rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                    <svg class="h-1.5 w-1.5 fill-green-500" viewBox="0 0 6 6">
                                        <circle cx="3" cy="3" r="3" />
                                    </svg>
                                    In Stock
                                </span>
                            @else
                                <span class="ml-2 inline-flex items-center gap-x-1.5 rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                                    <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6">
                                        <circle cx="3" cy="3" r="3" />
                                    </svg>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <p class="text-3xl tracking-tight text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="mt-1 text-sm text-gray-500">Free shipping on orders over Rp 1.000.000</p>
                    </div>

                    <div class="mt-8">
                        <div class="prose prose-sm text-gray-500">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>

                @if($product->stock > 0)
                    <form class="mt-6" action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="flex items-center">
                                <label for="quantity" class="mr-3 text-sm font-medium text-gray-700">Quantity</label>
                                <select name="quantity" id="quantity" class="rounded-md border-gray-300 py-1.5 text-sm focus:border-red-500 focus:ring-red-500">
                                    @for($i = 1; $i <= min($product->stock, 10); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="ml-3 text-sm text-gray-500">({{ $product->stock }} available)</span>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <button type="submit" class="flex flex-1 items-center justify-center rounded-md border border-transparent bg-red-600 px-8 py-3 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </div>
                    </form>
                @endif

                <!-- Product features -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h2 class="text-sm font-medium text-gray-900">Features & Benefits</h2>
                    <div class="prose prose-sm mt-4 text-gray-500">
                        <ul role="list" class="space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Free shipping on orders over Rp 1.000.000
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Secure payment with SSL encryption
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Easy returns within 7 days
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                24/7 Customer support
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-16 border-t border-gray-200 pt-8">
        <h2 class="text-xl font-bold text-gray-900 mb-8">Customer Reviews</h2>
        
        <!-- Review Form -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Write a Review</h3>
            <form action="{{ route('reviews.store', $product) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" 
                                class="rating-star p-1 hover:text-yellow-400 transition-colors {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}"
                                onclick="setRating({{ $i }})">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-input" value="4">
                </div>

                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                    <textarea id="comment" 
                            name="comment" 
                            rows="4" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm"
                            placeholder="Share your thoughts about this product..."></textarea>
                </div>

                <button type="submit" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Submit Review
                </button>
            </form>
        </div>

        <!-- Existing Reviews -->
        <div class="space-y-8">
            @forelse($product->reviews as $review)
                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="inline-block h-10 w-10 rounded-full bg-gray-200 overflow-hidden">
                            <svg class="h-full w-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-bold text-gray-900">{{ $review->user->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="mt-1 flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                     fill="currentColor" 
                                     viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            {{ $review->comment }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No reviews yet. Be the first to review this product!</p>
            @endforelse
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-16 sm:mt-24">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Related Products</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-red-600 hover:text-red-500">
                    View all
                    <span aria-hidden="true"> →</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="group relative">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-100">
                            @if($relatedProduct->getFirstMediaUrl('images'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     class="h-full w-full object-cover object-center group-hover:opacity-75">
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $relatedProduct->category->name }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- AI-Powered Recommendations -->
    <div class="mt-16 sm:mt-24">
        <x-product-recommendations :productId="$product->id" />
    </div>
</div>
@endsection

@push('scripts')
<script>
    function setRating(value) {
        document.getElementById('rating-input').value = value;
        const stars = document.querySelectorAll('.rating-star');
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }
</script>
@endpush
