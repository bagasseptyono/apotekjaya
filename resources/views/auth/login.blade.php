@extends('layouts.main')

@section('main')
<div class="container mt-5">
    <h3 class="mb-4">Login</h3>
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-success border border-success w-100">Login</button>
    </form>
    <a href="{{ route('register-form') }}" class="btn btn-light my-2 w-100 border border-success-subtle">Register</a>
</div>
@endsection
