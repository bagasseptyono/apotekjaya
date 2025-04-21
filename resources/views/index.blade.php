@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
            <div class="container py-5">
                <h1 class="display-5 fw-bold">Selamat Datang di <span class="text-success">ApotekJaya</span></h1>
                <p class="col-md-8 fs-4">
                    Temukan berbagai produk kesehatan terbaik hanya di toko online kami. Belanja mudah, cepat, dan terpercaya.
                </p>
                <a href="{{ route('products.index') }}" class="btn btn-success btn-lg">Lihat Produk</a>
            </div>
        </div>
        <h2 class="text-center">Kategori Produk</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($itemcategory as $category)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->image }}">
                    <div class="card-body">
                            <a href="{{ route('products.index', ['category' => $category->id]) }}" class="card-title text-center link-opacity-50-hover">
                                <h5 class=" link-opacity-50-hover">{{ $category->name }}</h5>
                            </a>
                        </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
