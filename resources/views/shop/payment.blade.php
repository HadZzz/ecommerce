<x-app-layout>
    <!-- Payment Header -->
    <div class="bg-gradient-to-r from-red-500 to-red-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Payment
                </h1>
                <p class="mt-3 text-xl text-red-100">
                    Complete your payment
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <!-- Order Details -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Order Details</h2>
                    <div class="border-t border-gray-200 pt-4">
                        <dl class="divide-y divide-gray-200">
                            <div class="py-3 flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Order Number</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $order->order_number }}</dd>
                            </div>
                            <div class="py-3 flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Total Amount</dt>
                                <dd class="text-sm font-medium text-red-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Payment Form -->
                <form id="payment-form" class="space-y-6">
                    <div>
                        <label for="card-element" class="block text-sm font-medium text-gray-700">
                            Credit or Debit Card
                        </label>
                        <div id="card-element" class="mt-1 p-3 border border-gray-300 rounded-md">
                            <!-- Stripe Elements will be inserted here -->
                        </div>
                        <div id="card-errors" class="mt-2 text-sm text-red-600" role="alert"></div>
                    </div>

                    <button type="submit" 
                            id="submit-button"
                            class="w-full bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center">
                        <span id="button-text">Pay Now</span>
                        <div id="spinner" class="hidden">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                </form>
            </div>

            <!-- Security Notice -->
            <div class="mt-6 text-center">
                <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                    <div class="flex items-center">
                        <i class="fas fa-lock text-green-500 mr-2"></i>
                        Secure Payment
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt text-blue-500 mr-2"></i>
                        Protected by Stripe
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Create a Stripe client
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();

    // Create an instance of the card Element
    const card = elements.create('card');

    // Add an instance of the card Element into the `card-element` div
    card.mount('#card-element');

    // Handle form submission
    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-button');
    const spinner = document.getElementById('spinner');
    const buttonText = document.getElementById('button-text');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        setLoading(true);

        try {
            const { paymentIntent, error } = await stripe.confirmCardPayment('{{ $clientSecret }}', {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: '{{ auth()->user()->name }}',
                        email: '{{ auth()->user()->email }}'
                    }
                }
            });

            if (error) {
                showError(error.message);
                setLoading(false);
            } else if (paymentIntent.status === 'succeeded') {
                window.location.href = '{{ route('payment.success') }}?order_id={{ $order->order_number }}';
            }
        } catch (err) {
            showError('An unexpected error occurred.');
            setLoading(false);
        }
    });

    // Handle errors
    card.addEventListener('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.textContent = error.message;
        } else {
            displayError.textContent = '';
        }
    });

    function setLoading(isLoading) {
        if (isLoading) {
            submitButton.disabled = true;
            spinner.classList.remove('hidden');
            buttonText.classList.add('opacity-0');
        } else {
            submitButton.disabled = false;
            spinner.classList.add('hidden');
            buttonText.classList.remove('opacity-0');
        }
    }

    function showError(message) {
        const errorDiv = document.getElementById('card-errors');
        errorDiv.textContent = message;
    }
</script> 