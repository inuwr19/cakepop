<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.customers.css')
    @yield('css')
</head>

<body>
    <!-- Header -->
    @include('layouts.customers.header')
    <!-- Close Header -->

    @yield('content')

    <!-- Start Footer -->
    @include('layouts.customers.footer')
    <!-- End Footer -->

    <!-- Start Script -->
    @include('layouts.customers.js')
    @yield('js')
    <!-- End Script -->
</body>
