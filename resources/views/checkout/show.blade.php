@extends('layouts.customers.index')

@section('content')
    <div class="container py-5" style="margin-top: 7rem;">
        <h2 class="mb-4">Checkout</h2>

        <!-- Menampilkan Produk yang Akan Dibeli -->
        <div class="mb-4">
            <h4>Produk dalam Keranjang</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp {{ number_format($item['price'], 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center ">
                            <strong>Total Pembayaran</strong>
                        </td>
                        <td class="text-center text-primary">
                            <strong>Rp {{ number_format($total, 2, ',', '.') }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Form Checkout -->
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <!-- Informasi Pribadi -->
            <div class="mb-4">
                <h4>Informasi Pribadi</h4>
                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ Auth::user()->name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ Auth::user()->email }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ Auth::user()->phone }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Alamat Pengiriman</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ Auth::user()->address?->address ?? '' }}</textarea>
                </div>
            </div>

            <!-- Total dan Tombol Checkout -->
            <div class="d-flex flex-row-reverse align-items-center mb-4">
                {{-- <h5>Total Pembayaran: <span class="text-primary">Rp {{ number_format($total, 2, ',', '.') }}</span></h5> --}}
                <input type="hidden" name="total" value="{{ $total }}">
                <button type="submit" class="btn btn-primary btn-lg">Lanjutkan Pembayaran</button>
            </div>
        </form>


    </div>
@endsection
