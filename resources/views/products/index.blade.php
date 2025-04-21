@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <h2 class="mb-4 text-center">Daftar Produk</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                            style="object-fit: cover; height: 200px;">
                        <div class="card-body">
                            <a href="{{ route('products.show', $product->id) }}">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </a>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="text-muted">Stok: {{ $product->stock }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('order.buy', $product->id) }}" class="btn btn-sm btn-success">Beli</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
