@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <h3 class="mb-4">Keranjang Belanja</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($cartItems->isEmpty())
        <div class="alert alert-info">Keranjang Anda kosong.</div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Lanjutkan Belanja</a>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cartItems as $item)
                    @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                    <tr>
                        <td style="width: 100px;">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td style="width: 150px;">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control form-control-sm me-2" min="1" max="{{ $item->product->stock }}">
                                <button class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-info">
                    <td colspan="4" class="text-end fw-bold">Total</td>
                    <td colspan="2" class="fw-bold">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('checkout.form') }}" class="btn btn-success">Lanjutkan ke Checkout</a>
        </div>
        @endif
    </div>
@endsection
