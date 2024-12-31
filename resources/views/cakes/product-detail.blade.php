@extends('layouts.customers.index')

@section('content')
    <!-- Product Detail Start -->
    <div class="container py-5" style="margin-top: 7rem;">
        <div class="row justify-content-center">
            <!-- Main Product Detail -->
            <div class="col-lg-10">
                <div class="product-detail bg-light p-5 rounded shadow-sm">
                    <div class="row g-4 align-items-center">
                        <!-- Product Image -->
                        <div class="col-md-6">
                            <img class="img-fluid w-100 rounded" src="{{ asset('customers/' . $cake->image) }}"
                                alt="{{ $cake->name }}" style="object-fit: cover; max-height: 400px;">
                        </div>

                        <!-- Product Information -->
                        <div class="col-md-6">
                            <h2 class="mb-3">{{ $cake->name }}</h2>
                            <h5 class="text-muted mb-3">Ukuran: {{ $cake->size }}</h5>
                            <h4 class="text-primary mb-4">Rp {{ number_format($cake->price, 2, ',', '.') }}</h4>
                            <p>{{ $cake->description }}</p>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="cake_id" value="{{ $cake->id }}">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Detail End -->

    <!-- Related Products Section -->
    <div class="container py-5">
        <div class="container">
            <h3 class="mb-5 text-center">Anda Mungkin Juga Suka</h3>
            <div class="row g-4">
                @foreach ($otherCakes as $other)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-item bg-white rounded p-3 shadow-sm text-center">
                            <img src="{{ asset('customers/' . $other->image) }}" class="img-fluid rounded mb-3"
                                alt="{{ $other->name }}" style="height: 200px; object-fit: cover; width: 100%;">
                            <h5 class="mb-2">{{ $other->name }}</h5>
                            <span class="text-primary d-block mb-3">Rp
                                {{ number_format($other->price, 2, ',', '.') }}</span>
                            <a href="{{ route('cakes.show', $other->id) }}" class="btn btn-outline-primary btn-sm">Lihat
                                Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
@endsection
