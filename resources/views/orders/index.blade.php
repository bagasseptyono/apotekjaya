@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <h3 class="mb-4">Daftar Pesanan Saya</h3>

        @forelse ($orders as $order)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p class="mb-1">Total: <strong>Rp{{ number_format($order->amount, 0, ',', '.') }}</strong></p>
                    <p class="mb-1">Metode Pembayaran: {{ $order->getPaymentMethodTextAttribute() }}</p>
                    <p class="mb-1">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="mb-1">
                        Status: <span
                            class="badge badge-sm
                        {{ $order->status == 'pending' ? 'bg-warning' : '' }}
                        {{ $order->status == 'proses' ? 'bg-info' : '' }}
                        {{ $order->status == 'selesai' ? 'bg-success' : '' }}
                        {{ $order->status == 'batal' ? 'bg-danger' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm mt-2">Lihat Detail</a>
                    {{-- @if (!in_array($order->status, ['selesai', 'batal']))
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin batalkan pesanan ini?')">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm">Batalkan</button>
                        </form>
                    @endif --}}


                    @if ($order->status === 'selesai' && !$order->feedback()->exists())
                        <a href="{{ route('feedback.create', $order->id) }}"
                            class="btn btn-outline-success btn-sm mt-2 ms-2">
                            Beri Feedback
                        </a>
                    @endif

                </div>
            </div>
        @empty
            <p>Tidak ada pesanan.</p>
        @endforelse
    </div>
@endsection
