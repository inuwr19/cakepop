@extends('layouts.customers.index')

@section('content')
    <div class="container py-5" style="margin-top:7rem;">
        <h2>Edit Profile</h2>

        <!-- User Information Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informasi Pengguna</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.user.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ Auth::user()->name }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ Auth::user()->email }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>

        <!-- Address Information Form -->
        <div class="card">
            <div class="card-header">
                <h5>Alamat</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.address.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Lengkap</label>
                        <input type="text" id="address" name="address" class="form-control"
                            value="{{ Auth::user()->address->address ?? '' }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="tel" id="phone" name="phone" class="form-control"
                            value="{{ Auth::user()->address->phone ?? '' }}" required>
                    </div>

                    <!-- City -->
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" id="city" name="city" class="form-control"
                            value="{{ Auth::user()->address->city ?? '' }}" required>
                    </div>

                    <!-- Postal Code -->
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Kode Pos</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control"
                            value="{{ Auth::user()->address->postal_code ?? '' }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Alamat</button>
                </form>
            </div>
        </div>
    </div>
@endsection
