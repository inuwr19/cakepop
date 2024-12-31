<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s"
        style="background-color: #FFC0CB">
        <!-- Logo dan Nama -->
        <a href="{{ route('cakes.index') }}" class="navbar-brand ms-4 ms-lg-0 d-flex align-items-center">
            <img src="{{ asset('customers') }}/assets/images/gambarlogo.png" width="100" height="100" alt="">
            <h1 class="fw-bold text-primary m-0 ms-2">C<span class="text-secondary">ake Po</span>p</h1>
        </a>

        <!-- Tombol Toggle -->
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <!-- Search Bar -->
            <form action="{{ route('cakes.search') }}" method="GET" class="search-form d-flex mx-auto">
                <input class="form-control search-bar me-2" type="search" name="query" placeholder="Search cakes..."
                    aria-label="Search" required>
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- Menu Navigasi -->
            <div class="navbar-nav p-4 p-lg-0">
                <a href="{{ route('cakes.index') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('cakes.about') }}" class="nav-item nav-link">About Us</a>
                <a href="{{ route('cakes.product') }}" class="nav-item nav-link">Products</a>
            </div>

            <!-- Ikon dan User Options -->
            <div class="d-flex align-items-center">
                @auth
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
