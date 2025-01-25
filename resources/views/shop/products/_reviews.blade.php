<!-- Reviews Section -->
<div class="mt-12">
    <h2 class="text-2xl font-bold mb-4">Reviews</h2>
    
    <!-- Review Stats -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="flex items-center space-x-4">
            <div>
                <div class="text-3xl font-bold">{{ number_format($product->average_rating, 1) }}</div>
                <div class="text-sm text-gray-600">out of 5</div>
            </div>
            <div class="flex-1">
                <div class="text-sm text-gray-600">{{ $product->reviews_count }} reviews</div>
                <!-- Star rating display -->
                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($product->average_rating))
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
    
    <!-- Review Form -->
    @auth
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <h3 class="text-lg font-semibold mb-4">Write a Review</h3>
            <form action="{{ route('reviews.store', $product) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" id="rating-{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                            <label for="rating-{{ $i }}" class="cursor-pointer">
                                <svg class="w-8 h-8 peer-checked:text-yellow-400 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                    <textarea name="comment" id="comment" rows="4" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Share your thoughts about this product...">{{ old('comment') }}</textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Submit Review
                </button>
            </form>
        </div>
    @else
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <p>Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to write a review.</p>
        </div>
    @endauth
    
    <!-- Reviews List -->
    <div class="space-y-6">
        @forelse($product->reviews()->with('user')->latest()->get() as $review)
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="font-semibold">{{ $review->user->name }}</div>
                        <div class="flex items-center space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $review->created_at->diffForHumans() }}
                        @if($review->verified_purchase)
                            <span class="ml-2 text-green-600 text-xs">✓ Verified Purchase</span>
                        @endif
                    </div>
                </div>
                <p class="text-gray-700">{{ $review->comment }}</p>
                @if(auth()->id() === $review->user_id)
                    <form action="{{ route('reviews.destroy', $product) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 text-sm hover:underline">
                            Delete Review
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No reviews yet. Be the first to review this product!</p>
        @endforelse
    </div>
</div>
