@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Process</div>

                <div class="card-body">
                    <h3>Order Details</h3>
                    <p>Order ID: {{ $order->id }}</p>
                    <p>Total Amount: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                    <div class="payment-methods">
                        <h4 class="mb-3">Select Payment Method</h4>
                        
                        <!-- Bank Transfer -->
                        <div class="payment-group mb-4">
                            <h5>Bank Transfer</h5>
                            <div class="list-group">
                                <button class="list-group-item list-group-item-action" onclick="payWithBank('bca')">
                                    <img src="{{ asset('images/banks/bca.png') }}" alt="BCA" class="bank-logo">
                                    BCA Virtual Account
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="payWithBank('bni')">
                                    <img src="{{ asset('images/banks/bni.png') }}" alt="BNI" class="bank-logo">
                                    BNI Virtual Account
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="payWithBank('bri')">
                                    <img src="{{ asset('images/banks/bri.png') }}" alt="BRI" class="bank-logo">
                                    BRI Virtual Account
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="payWithBank('mandiri')">
                                    <img src="{{ asset('images/banks/mandiri.png') }}" alt="Mandiri" class="bank-logo">
                                    Mandiri Virtual Account
                                </button>
                            </div>
                        </div>

                        <!-- E-Wallet -->
                        <div class="payment-group mb-4">
                            <h5>E-Wallet</h5>
                            <div class="list-group">
                                <button class="list-group-item list-group-item-action" onclick="payWithEwallet('gopay')">
                                    <img src="{{ asset('images/ewallets/gopay.png') }}" alt="GoPay" class="ewallet-logo">
                                    GoPay
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="payWithEwallet('shopeepay')">
                                    <img src="{{ asset('images/ewallets/shopeepay.png') }}" alt="ShopeePay" class="ewallet-logo">
                                    ShopeePay
                                </button>
                            </div>
                        </div>

                        <!-- Convenience Store -->
                        <div class="payment-group">
                            <h5>Convenience Store</h5>
                            <div class="list-group">
                                <button class="list-group-item list-group-item-action" onclick="payWithStore('indomaret')">
                                    <img src="{{ asset('images/stores/indomaret.png') }}" alt="Indomaret" class="store-logo">
                                    Indomaret
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="payWithStore('alfamart')">
                                    <img src="{{ asset('images/stores/alfamart.png') }}" alt="Alfamart" class="store-logo">
                                    Alfamart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-methods img {
    height: 30px;
    margin-right: 10px;
}
.list-group-item {
    display: flex;
    align-items: center;
    cursor: pointer;
}
.payment-group h5 {
    margin-bottom: 1rem;
    color: #666;
}
</style>

<!-- Include Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    function initializePayment() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = '/payment/finish?order_id={{ $order->id }}&status=success';
            },
            onPending: function(result) {
                window.location.href = '/payment/unfinish?order_id={{ $order->id }}&status=pending';
            },
            onError: function(result) {
                window.location.href = '/payment/error?order_id={{ $order->id }}&status=error';
            },
            onClose: function() {
                alert('You closed the payment window without completing the payment');
            }
        });
    }

    function payWithBank(bank) {
        initializePayment();
    }

    function payWithEwallet(ewallet) {
        initializePayment();
    }

    function payWithStore(store) {
        initializePayment();
    }
</script>
@endsection 