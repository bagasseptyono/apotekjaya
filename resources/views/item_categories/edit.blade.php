@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>

    <div class="container my-5">
        <form action="{{ route('item-categories.update', $itemCategory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">Nama Kategori</label>
                <input type="text" class="form-control" name="name" value="{{ $itemCategory->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image">Gambar (opsional)</label>
                <input type="file" class="form-control" name="image">
                @if ($itemCategory->image)
                    <img src="{{ asset('storage/' . $itemCategory->image) }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('item-categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
