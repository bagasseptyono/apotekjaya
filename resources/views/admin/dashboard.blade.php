@extends('layouts.admin-main')

@section('admin')
<div class="container-fluid py-4">
    <h3 class="mb-4">Dashboard Admin</h3>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-box"></i> Total Produk
                    </h5>
                    <p class="card-text fs-4">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-layer-group"></i> Kategori
                    </h5>
                    <p class="card-text fs-4">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-shopping-cart"></i> Pesanan
                    </h5>
                    <p class="card-text fs-4">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-money-bill-wave"></i> Total Pendapatan
                    </h5>
                    <p class="card-text fs-4">Rp{{ number_format($totalAmount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-users"></i> Pengguna
                    </h5>
                    <p class="card-text fs-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
