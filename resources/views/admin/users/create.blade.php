@extends('layouts.admin-main')

@section('admin')
    <div class="container my-5">
        <h2>Tambah Pengguna</h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">No. HP</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number ?? '') }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-select">
                    <option value="0" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="0" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" name="city" value="{{ old('city', $user->city ?? '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            @if (!isset($user->id))
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            @endif


            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
