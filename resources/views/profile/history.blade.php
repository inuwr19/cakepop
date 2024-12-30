@extends('layouts.customers.index')

@section('content')
<div class="container">
    <h1>Order History</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                <td>${{ $order->total_amount }}</td>
                <td>{{ $order->payments->first()->payment_method }}</td>
                <td><a href="{{ route('profile.invoice', $order->id) }}" class="btn btn-info">View Invoice</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
