@extends('layouts.customers.index')

@section('content')
    <div class="container py-5" style="margin-top: 7rem;">
        <h2 class="mb-4">Order History</h2>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>Rp {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                        <td>
                            @php
                                $paymentStatus = $order->payments->first()->status ?? 'unknown'; // Ambil status pertama dari payments
                            @endphp

                            @if ($paymentStatus === 'pending')
                                <span class="badge bg-danger">Failed</span>
                                {{-- <span class="badge bg-warning text-dark">Pending</span> --}}
                            @elseif ($paymentStatus === 'success')
                                <span class="badge bg-success">Success</span>
                            @elseif ($paymentStatus === 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('invoice.show', $order->id) }}" class="btn btn-primary btn-sm">View Invoice</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
