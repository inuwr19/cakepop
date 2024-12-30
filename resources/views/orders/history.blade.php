@extends('layouts.customers.index')

@section('content')
<div class="container py-5 mt-5">
    <h2 class="mb-4">Order History</h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>Rp {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                    {{-- <td>{{ $order->payments->first()->payment_method }}</td> --}}
                    <td>
                        <a href="{{ route('invoice.show', $order->id) }}" class="btn btn-primary btn-sm">View Invoice</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
