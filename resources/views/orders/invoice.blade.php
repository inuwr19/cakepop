@extends('layouts.customers.index')

@section('content')
    <div class="container py-5" style="margin-top: 7rem;">
        <h2 class="mb-4">Invoice</h2>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Order Details</h5>
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Total Amount:</strong> Rp {{ number_format($order->total_amount, 2, ',', '.') }}</p>
                <p><strong>Payment Method:</strong>
                    {{ optional($order->payments->first())->payment_method ?? 'Not Available' }}
                </p>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Shipping Address</h5>
                <p><strong>Address:</strong> {{ $order->address->address }}</p>
                <p><strong>City:</strong> {{ $order->address->city }}</p>
                <p><strong>Postal Code:</strong> {{ $order->address->postal_code }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('orders.history') }}" class="btn btn-secondary">Back to Order History</a>
        </div>
    </div>
@endsection
