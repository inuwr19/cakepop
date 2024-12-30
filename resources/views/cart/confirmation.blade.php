@extends('layouts.customers.index')

@section('content')
    <style>
        .table thead th {
            font-weight: bold;
        }

        .table tfoot td {
            font-size: 1.2em;
            color: #333;
        }

        .btn-lg {
            padding: 0.75rem 1.25rem;
        }

        h2,
        h3 {
            font-weight: 600;
        }

        label {
            font-weight: 500;
        }
    </style>
    <div class="container py-5 mt-5">
        <h2 class="mb-4 text-center">Purchase Confirmation</h2>

        <!-- Cart Summary -->
        <div class="table-responsive mb-5">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 2, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total</strong></td>
                        <td><strong>Rp {{ number_format($total, 2, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Customer Information Form -->
        <h3 class="mb-3">Customer Information</h3>
        <form action="{{ route('order.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ Auth::user()->address?->address ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="cash">Cash on Delivery</option>
                </select>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success btn-lg">Proceed to Payment</button>
            </div>
        </form>
    </div>
@endsection
