@extends('layouts.admin-main')


@section('admin')
<div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Order</h2>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Total</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td>Rp{{ number_format($order->amount, 0, ',', '.') }}</td>
                            <td>
                                @if ($order->payment_method == 1)
                                    Bank Transfer
                                @else
                                    Cash
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <span class="badge badge-sm
                                    {{ $order->status == 'pending' ? 'bg-warning' : '' }}
                                    {{ $order->status == 'proses' ? 'bg-info' : '' }}
                                    {{ $order->status == 'selesai' ? 'bg-success' : '' }}
                                    {{ $order->status == 'batal' ? 'bg-danger' : '' }}"
                                >
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    @if($order->payment_method == 1)
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <select name="status" class="form-select form-select-sm" >
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="batal" {{ $order->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                            <button class="btn btn-success" type="submit">Ubah</button>
                                        </div>
                                    </form>
                                @else
                                    <span class="badge bg-secondary">Cash - Tidak Perlu Status</span>
                                @endif
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
