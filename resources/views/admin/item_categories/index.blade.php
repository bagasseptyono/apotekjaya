@extends('layouts.admin-main')

@section('admin')
<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Kategori</h2>
        <a href="{{ route('item-categories.create') }}" class="btn btn-success mb-3">+ Tambah Kategori</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $index => $cat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>
                        @if ($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" width="80" alt="{{ $cat->name }}">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('item-categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('item-categories.destroy', $cat->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data kategori</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
