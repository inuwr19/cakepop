@extends('layouts.customers.index')

@section('content')
    <div class="container py-5" style="margin-top:7rem">
        <h2 class="mb-4">Hasil Pencarian untuk: "{{ $query }}"</h2>

        @if ($cakes->count())
            <div class="row">
                @foreach ($cakes as $cake)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('customers/' . $cake->image) }}" class="card-img-top" alt="{{ $cake->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cake->name }}</h5>
                                <p class="card-text">{{ $cake->description }}</p>
                                <p class="card-text text-primary">Rp {{ number_format($cake->price, 2, ',', '.') }}</p>
                                <a href="{{ route('cakes.show', $cake->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $cakes->links() }}
            </div>
        @else
            <p class="text-muted">Tidak ada hasil ditemukan untuk "{{ $query }}"</p>
        @endif
    </div>
@endsection
