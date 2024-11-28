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
</style>
<div class="container py-5 mt-5">
    <h2 class="mb-4">Konfirmasi Pembelian</h2>

    <!-- Ringkasan Keranjang -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
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

    <!-- Form Data Diri -->
    <h3 class="mb-3">Data Diri Pembeli</h3>
    <form action="{{ route('checkout.show') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <!-- Tombol Checkout -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success btn-lg">Lanjutkan ke Pembayaran</button>
        </div>
    </form>
</div>
@endsection
