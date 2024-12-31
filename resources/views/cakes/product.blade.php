@extends('layouts.customers.index')

@section('content')
    <div class="container-xxl py-5" style="margin-top:7rem">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Our Products</h1>
                        <p>Discover a delightful array of high-quality baked goods, crafted to bring joy to every moment.
                            From classic favorites to innovative creations, our products are designed to satisfy every taste
                            and preference.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" href="#tab-1">Wedding
                                Cake</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Birthday Cake
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @foreach ($cakes as $cake)
                            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="product-item">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('customers/' . $cake->image) }}"
                                            style="height:300px;" alt="">
                                        <div
                                            class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            New</div>
                                    </div>
                                    <div class="text-center p-4">
                                        <a class="d-block h5 mb-2" href="">{{ $cake->name }}</a>
                                        <span class="text-primary me-1">Rp
                                            {{ number_format($cake->price, 2, ',', '.') }}</span>
                                        {{-- <span class="text-body text-decoration-line-through">$29.00</span> --}}
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="w-50 text-center border-end py-2">
                                            <a class="text-body" href="{{ route('cakes.show', $cake->id) }}">
                                                <i class="fa fa-eye text-primary me-2"></i>View detail
                                            </a>
                                        </small>
                                        <!-- Add to Cart Form -->
                                        {{-- <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="cake_id" value="{{ $cake->id }}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa fa-shopping-cart me-2"></i>Add to cart
                                    </button>
                                </form> --}}
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cake_id" value="{{ $cake->id }}">
                                            <small class="w-50 text-center py-2">
                                                <button type="submit" class="btn btn-link text-body p-2"
                                                    style="text-decoration: none;">
                                                    <i class="fa fa-shopping-bag text-primary me-2"></i>Add to cart
                                                </button>
                                            </small>
                                        </form>

                                        {{-- <small class="w-50 text-center py-2">
                                            <a class="text-body" href=""><i
                                                    class="fa fa-shopping-bag text-primary me-2"></i>Add to cart</a>
                                        </small> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="">Browse More Products</a>
                    </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
