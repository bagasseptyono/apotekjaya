@extends('layouts.main')

@section('main')
    <div class="container my-5">
        <div class="container mt-5">
            <h3 class="mb-4">Register</h3>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="col">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email address" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                </div>

                <div class="mb-3">
                    <select name="gender" class="form-select" required>
                        <option selected disabled>Choose Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="city" class="form-control" placeholder="City" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
            <a href="{{ route('login-form') }}" class="btn btn-light my-2 w-100 border border-success-subtle">Login</a>

        </div>

    </div>
@endsection
