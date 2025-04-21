@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <h2>Beli Produk: {{ $product->name }}</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ route('cart.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                            class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                </form>

            </div>
        </div>
    </div>
@endsection
