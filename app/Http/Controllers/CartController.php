<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();
        try {
            $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

            $order = Order::create([
                'user_id' => $userId,
                'amount' => $totalAmount,
                'payment_method' => 1, // default
                'payment_image' => 'default.png', // sementara
            ]);

            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'total' => $item->product->price * $item->quantity,
                ]);
            }

            // Bersihkan keranjang
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        $cart = Cart::where('user_id',auth()->id())->where('product_id',auth()->id())->first();


        if (!$cart) {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        } else {
            $cart->quantity += $request->quantity;
            $cart->update();
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart = Cart::where('id', $id);
        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id',$id)->first();
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
