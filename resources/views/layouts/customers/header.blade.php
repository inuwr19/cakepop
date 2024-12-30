<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('cakes.index') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">C<span class="text-secondary">ake Po</span>p</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('cakes.index') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('cakes.about') }}" class="nav-item nav-link">About Us</a>
                <a href="{{ route('cakes.product') }}" class="nav-item nav-link">Products</a>
                {{-- <a href="contact.html" class="nav-item nav-link">Contact Us</a> --}}
            </div>
            <div class="d-none d-lg-flex ms-2">
                {{-- <a class="btn-sm-square bg-white rounded-circle ms-3" href="#">
                    <small class="fa fa-search text-body"></small>
                </a> --}}

                @auth
                    <!-- Jika User Sudah Login -->
                    <div class="dropdown ms-3">
                        <a class="btn-sm-square bg-white rounded-circle" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.user') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.history') }}">Order History</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <!-- Jika User Belum Login -->
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="{{ route('login') }}">
                        <small class="fa fa-user text-body"></small>
                    </a>
                @endguest

                <a class="btn-sm-square bg-white rounded-circle ms-3" href="{{ route('cart.index') }}">
                    <small class="fa fa-shopping-bag text-body"></small>
                </a>
            </div>
        </div>
    </nav>
</div>
