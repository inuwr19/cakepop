@extends('layouts.customers.index')

@section('content')
<div class="container py-5 mt-5">
    <h2 class="mb-4">Checkout</h2>

    <!-- Form Checkout -->
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <!-- Informasi Pribadi -->
        <div class="mb-4">
            <h4>Informasi Pribadi</h4>
            <div class="form-group mb-3">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="phone">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group mb-3">
                <label for="address">Alamat Pengiriman</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ Auth::user()->address?->address ?? '' }}</textarea>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <h4>Metode Pembayaran</h4>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="payment_method" id="payment1" value="credit_card" required>
                <label class="form-check-label" for="payment1">
                    Kartu Kredit
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="payment_method" id="payment2" value="bank_transfer" required>
                <label class="form-check-label" for="payment2">
                    Transfer Bank
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="payment_method" id="payment3" value="paypal" required>
                <label class="form-check-label" for="payment3">
                    PayPal
                </label>
            </div>
        </div>

        <!-- Total dan Tombol Checkout -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Total Pembayaran: <span class="text-primary">Rp {{ number_format($total, 2, ',', '.') }}</span></h5>
            <button type="submit" class="btn btn-primary btn-lg">Lanjutkan Pembayaran</button>
        </div>
    </form>
</div>
@endsection
