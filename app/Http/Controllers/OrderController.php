<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('orders.buy', compact('product'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
        $total = $product->price * $quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'amount' => $total,
            'payment_method' => 1, // default (misal: Transfer Bank)
            'payment_image' => 'default.png', // ubah sesuai kebutuhan
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total' => $total,
            'order_id' => $order->id,
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Pembelian berhasil');
    }

    public function checkout(Request $request)
    {
        if ($request->payment_method == 1) {
            $request->validate([
                'payment_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);
            $imagePath = $request->file('payment_image')->store('payments', 'public');
        }

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);


        $order = Order::create([
            'user_id' => auth()->id(),
            'amount' => $total,
            'payment_method' => $request->payment_method,
            'payment_image' => $imagePath ?? '',
            'status' => $request->status
        ]);

        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total' => $item->quantity * $item->product->price,
            ]);

            $product = Product::find($item->product_id);
            $product->stock -= $item->quantity;
            $product->save();
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat!');
    }

    public function showCheckoutForm()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'order_details.product', 'feedback'])->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::with('order_details.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function exportPdf($id)
    {
        $order = Order::with(['order_details.product','user'])->findOrFail($id);

        $pdf = FacadePdf::loadView('orders.pdf', compact('order'));

        return $pdf->stream('invoice_order_' . $order->id . '.pdf');
    }


    //Admin
    public function getOrderAdmin()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->payment_method != 1) {
            return back()->with('error', 'Hanya pesanan dengan metode transfer yang bisa diubah statusnya.');
        }

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
