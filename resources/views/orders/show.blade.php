@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <div class="flex flex-row justify-content-between">
            <h3 class="mb-4">Detail Pesanan</h3>
            <a href="{{ route('orders.exportPdf', $order->id) }}" class="btn btn-warning mb-3" target="_blank">
                <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
            </a>
        </div>


        <div class="card mb-4">
            <div class="card-header bg-light">
                <strong>Informasi Pemesanan</strong>
            </div>
            <div class="card-body">
                <p><strong>ID Order:</strong> {{ $order->id }}</p>
                <p><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                <p><strong>Nama Pembeli:</strong> {{ $order->user->name }}</p>
                <p><strong>Total Pembayaran:</strong> Rp{{ number_format($order->amount, 0, ',', '.') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $order->getPaymentMethodTextAttribute() }}
                </p>
                <p>
                    <strong>Status:</strong> <span
                        class="badge badge-sm
                    {{ $order->status == 'pending' ? 'bg-warning' : '' }}
                    {{ $order->status == 'proses' ? 'bg-info' : '' }}
                    {{ $order->status == 'selesai' ? 'bg-success' : '' }}
                    {{ $order->status == 'batal' ? 'bg-danger' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                @if ($order->payment_method == 1)
                    <p><strong>Bukti Pembayaran:</strong></p>
                    <img src="{{ asset('storage/' . $order->payment_image) }}" alt="Bukti Pembayaran" class="img-thumbnail"
                        style="max-height: 200px;">
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Produk yang Dibeli</strong>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_details as $detail)
                            <tr>
                                <td>{{ $detail->product->name }}</td>
                                <td>Rp{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp{{ number_format($detail->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-header bg-light">
                <strong>Feedback</strong>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pesan</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    @if ($order->feedback)
                        <tbody>
                            <tr>
                                <td>{{ $order->feedback->message ?? '' }}</td>
                                <td>Rp{{ $order->feedback->rating ?? '' }}</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
