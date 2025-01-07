<x-app-layout>
    <!-- Payment Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Payment
                </h1>
                <p class="mt-3 text-xl text-blue-100">
                    Complete your payment to finish your order
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Order Summary</h2>
                        <p class="mt-2 text-gray-600">Order Number: {{ $order->order_number }}</p>
                    </div>

                    <!-- Order Amount -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-gray-900">Total Amount:</span>
                            <span class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="text-center">
                        <button id="pay-button" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            <i class="fas fa-credit-card mr-2"></i>
                            Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                window.location.href = '{{ route("checkout.success", $order->order_number) }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route("checkout.success", $order->order_number) }}';
            },
            onError: function(result) {
                alert("Payment failed!");
            },
            onClose: function() {
                alert('You closed the popup without finishing the payment');
            }
        });
    });
</script>
@endpush 