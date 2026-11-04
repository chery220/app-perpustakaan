@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <a href="{{ route('categories.index') }}">&larr; Kembali ke daftar</a>

    <h2>Tambah Kategori</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label for="name">Nama Kategori:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection