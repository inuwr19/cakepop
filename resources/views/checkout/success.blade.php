@extends('layouts.customers.index')

@section('content')
    <div class="container py-5 mt-5 text-center">
        <h2>Checkout Berhasil</h2>
        <p class="mb-4">Terima kasih atas pesanan Anda! Kami akan segera memproses pesanan Anda.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
@endsection
