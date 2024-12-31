@extends('layouts.customers.index')

@section('content')
    <div class="container py-5" style="margin-top:7rem; margin-bottom:5rem">
        <h2 class="mb-4">Keranjang Belanja Anda</h2>

        @if (session('cart') && count(session('cart')) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        <tr>
                            <td><img src="{{ asset('customers/' . $item['image']) }}" width="70" class="rounded"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 2, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cake_id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                        class="form-control w-50 d-inline">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cake_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                <!-- Tombol Lanjutkan ke Konfirmasi -->
                <h4>Total: Rp {{ number_format($totalPrice, 2, ',', '.') }}</h4>
                <a href="{{ route('checkout.show') }}" class="btn btn-primary btn-lg">Lanjutkan ke Konfirmasi</a>
            </div>
        @else
            <p class="alert alert-info">Keranjang belanja Anda kosong.</p>
        @endif
    </div>
@endsection
