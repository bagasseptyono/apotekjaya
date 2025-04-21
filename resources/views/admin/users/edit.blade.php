@extends('layouts.admin-main')

@section('admin')
    <div class="container my-5">
        <h2>Edit</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" value="{{ $user->name  }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email  }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="{{ $user->username  }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">No. HP</label>
                <input type="text" name="phone_number" value="{{ $user->phone_number  }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-select">
                    <option value="0" {{ $user->gender  == 'male' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="1" {{ $user->gender  == 'female' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" name="address" value="{{ $user->address  }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" name="city" value="{{ $user->city  }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="user" {{ $user->role  == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role  == 'admin' ? 'selected' : '' }}>Admin</option>
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
