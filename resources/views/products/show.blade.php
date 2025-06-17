@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm mb-4"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $product->name }}</h2>
                <h5 class="fw-bold">Category : {{ $itemcategory->name }}</h5>
                <p class="text-muted">{{ $product->description }}</p>
                <p><strong>Stok:</strong> {{ $product->stock }}</p>
                <h4 class="text-success">Rp{{ number_format($product->price, 0, ',', '.') }}</h4>

                <div class="mt-4">
                    <a href="{{ route('order.buy', $product->id) }}" class="btn btn-success me-2">Beli Sekarang</a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
