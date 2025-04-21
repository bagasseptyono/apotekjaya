<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Order #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Invoice Order #{{ $order->id }}</h2>
    <p>Tanggal: {{ $order->created_at->format('d-m-Y') }}</p>
    <p>Metode Pembayaran: {{ $order->payment_method == 1 ? 'Bank Transfer' : 'Cash' }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->order_details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($detail->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="text-align: right;">Total Bayar: Rp{{ number_format($order->amount, 0, ',', '.') }}</h4>
</body>
</html>
