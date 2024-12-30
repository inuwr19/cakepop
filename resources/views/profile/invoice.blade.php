@extends('layouts.customers.index')

@section('content')
<div class="container">
    <h1>Invoice #{{ $order->id }}</h1>
    <p>Date: {{ $order->created_at->format('d-m-Y') }}</p>
    <p>Total Amount: ${{ $order->total_amount }}</p>
    <p>Payment Method: {{ $order->payments->first()->payment_method }}</p>
    <p>Address: {{ $order->address->address }}, {{ $order->address->city }}, {{ $order->address->postal_code }}</p>

    <a href="{{ route('profile.history') }}" class="btn btn-primary">Order History</a>
</div>
@endsection
