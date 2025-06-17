@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <h3>Checkout</h3>

        <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>Rp{{ number_format($item->product->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->quantity * $item->product->price) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong>Rp{{ number_format($total) }}</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-select" required onchange="checkPaymentMethod()">
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="1">Bank Transfer</option>
                    <option value="2">Cash</option>
                </select>
            </div>

            <!-- Hidden input untuk status -->
            <input type="hidden" name="status" id="status_input">


            <div class="mb-3" id="paymentImageContainer" style="display: none;">
                <p>Bayar Melalui Transfer <br> BCA. 727271621</p>
                <label for="payment_image" class="form-label">Upload Bukti Pembayaran (JPG/PNG)</label>
                <input type="file" name="payment_image" class="form-control" accept="image/png, image/jpeg">
            </div>




            <button class="btn btn-success">Buat Pesanan</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethod = document.getElementById('payment_method');
            const paymentImageContainer = document.getElementById('paymentImageContainer');

            paymentMethod.addEventListener('change', function() {
                if (this.value === '1') {
                    paymentImageContainer.style.display = 'block';
                } else {
                    paymentImageContainer.style.display = 'none';
                }
            });
        });
        function checkPaymentMethod() {
        const paymentMethod = document.getElementById('payment_method').value;
        const statusInput = document.getElementById('status_input');

        if (paymentMethod === '2') {
            statusInput.value = 'pending'; // Cash
        } else {
            statusInput.value = 'pending'; // Bank Transfer atau lainnya
        }
    }
    </script>
@endpush
