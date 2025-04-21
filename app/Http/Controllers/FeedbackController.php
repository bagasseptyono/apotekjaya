<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function create($id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id !== Auth::id() || $order->status !== 'selesai') {
            abort(403, 'Unauthorized action.');
        }

        return view('feedback.create', compact('order'));
    }

    public function store(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id() || $order->status !== 'selesai') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Feedback::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->route('orders.index')->with('success', 'Feedback berhasil dikirim.');
    }

    public function index()
    {
        $feedbacks = Feedback::with(['user', 'order'])->latest()->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }


}
