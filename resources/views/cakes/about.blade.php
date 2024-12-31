@extends('layouts.customers.index')

@section('content')
    <div class="bg-image"
        style="background-image: url('{{ asset('customers/assets/images/aboutus.png') }}'); background-size: cover;  ">
        <div class="container pt-5" style="margin-top: 6rem;">
            <h1 class="text-center mb-4">About Us</h1>
            <div class="row">
                <div class="col-md-12">
                    <h2>Welcome to CakePop</h2>
                    <p>
                        At CakePop, we specialize in crafting delicious and beautiful cakes for every occasion. Our mission
                        is
                        to bring sweetness and joy to your celebrations with our premium baked goods.
                    </p>
                    <h4>Our Vision</h4>
                    <p>
                        To be the leading provider of cakes and desserts, known for our quality, creativity, and exceptional
                        service.
                    </p>
                    <h4>Our Mission</h4>
                    <ul>
                        <li>To deliver freshly baked, high-quality cakes using the finest ingredients.</li>
                        <li>To provide exceptional customer service and create unforgettable experiences.</li>
                        <li>To innovate with new flavors and designs to meet our customers' needs.</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3 class="text-center">Contact Us</h3>
                    <p class="text-center">
                        Have questions or special requests? Reach out to us, and we'll be happy to assist!
                    </p>
                    <div class="text-center">
                        <p><strong>Email:</strong> support@cakepop.com</p>
                        <p><strong>Phone:</strong> +123 456 789</p>
                        <p><strong>Address:</strong> 123 Sweet Lane, CakeTown, Cakeland</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
