@extends('layouts.main')

@section('main')
<div class="container my-5">
    <h4>Beri Feedback untuk Order #{{ $order->id }}</h4>

    <form action="{{ route('feedback.store', $order->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5">
        </div>
        <button class="btn btn-success">Kirim Feedback</button>
    </form>
</div>
@endsection
