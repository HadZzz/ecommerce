@extends('shop.layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Images -->
            <div class="w-full md:w-1/2">
                @if($product->getFirstMediaUrl('images'))
                    <img src="{{ $product->getFirstMediaUrl('images') }}" 
                         alt="{{ $product->name }}"
                         class="w-full rounded-lg">
                @endif
            </div>

            <!-- Product Details -->
            <div class="w-full md:w-1/2">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                
                <div class="text-sm text-gray-500 mb-4">
                    Category: 
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" 
                       class="text-blue-500 hover:text-blue-600">
                        {{ $product->category->name }}
                    </a>
                </div>

                <div class="text-2xl font-bold mb-6">
                    Rp {{ number_format($product->price, 0) }}
                </div>

                <div class="prose max-w-none mb-6">
                    {!! $product->description !!}
                </div>

                @if($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="flex items-center gap-4 mb-6">
                            <label for="quantity" class="font-medium">Quantity:</label>
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product->stock }}"
                                   class="w-20 px-3 py-2 border rounded-lg">
                        </div>

                        <button type="submit" 
                                class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <div class="text-red-500 font-medium mb-6">Out of Stock</div>
                @endif
            </div>
        </div>
    </div>

    @include('shop.products._reviews')

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Related Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        @if($relatedProduct->getFirstMediaUrl('images'))
                            <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}" 
                                 alt="{{ $relatedProduct->name }}"
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">{{ $relatedProduct->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($relatedProduct->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">Rp {{ number_format($relatedProduct->price, 0) }}</span>
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    function setRating(value) {
        document.getElementById('rating-input').value = value;
        const stars = document.querySelectorAll('.rating-star');
        stars.forEach((star, index) => {
            star.classList.toggle('text-yellow-400', index < value);
            star.classList.toggle('text-gray-400', index >= value);
        });
    }
</script>
@endpush
