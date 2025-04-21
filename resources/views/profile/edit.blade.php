@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="container my-5">
        <h4>Edit Profil</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">No. Telepon</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Jenis Kelamin</label>
            <select name="gender" class="form-select">
                <option value="">-- Pilih --</option>
                <option value="0" {{ $user->gender == '0' ? 'selected' : '' }}>Laki-laki</option>
                <option value="1" {{ $user->gender == '1' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Kota</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
    </div>
@endsection
