@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">My Wishlist</h1>

    @if(isset($wishlistItems) && $wishlistItems->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($wishlistItems as $item)
                @if($item->product)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="relative aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-t-lg">
                            @if($item->product->getFirstMediaUrl('images'))
                                <img src="{{ $item->product->getFirstMediaUrl('images') }}"
                                     alt="{{ $item->product->name }}"
                                     class="h-full w-full object-cover object-center">
                            @else
                                <img src="https://placehold.co/800x600/EEE/31343C?font=montserrat&text={{ urlencode($item->product->name) }}"
                                     alt="{{ $item->product->name }}"
                                     class="h-full w-full object-cover object-center">
                            @endif

                            <form action="{{ route('wishlist.toggle', $item->product) }}"
                                  method="POST"
                                  class="absolute top-2 right-2">
                                @csrf
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-md hover:shadow-lg transform hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-heart text-xl text-red-500"></i>
                                </button>
                            </form>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                {{ $item->product->name }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-4">
                                {{ Str::limit($item->product->description, 100) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </span>
                                <form action="{{ route('cart.add', $item->product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="mb-4">
                <i class="far fa-heart text-6xl text-gray-300"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Your wishlist is empty</h3>
            <p class="text-gray-500 mb-4">Browse our products and add some items to your wishlist</p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-shopping-bag mr-2"></i>
                Browse Products
            </a>
        </div>
    @endif
</div>
@endsection
