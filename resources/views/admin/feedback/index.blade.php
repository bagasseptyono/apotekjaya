@extends('layouts.admin-main')

@section('admin')
<div class="container my-5">
    <h4>Daftar Feedback Pengguna</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Rating</th>
                <th>Pesan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>#{{ $feedback->order_id }}</td>
                <td>{{ $feedback->user->name }}</td>
                <td>{{ $feedback->rating ?? '-' }}</td>
                <td>{{ Str::limit($feedback->message, 40) }}</td>
                <td>{{ $feedback->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
