@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 space-y-6">
    <!-- Header & Tombol Kembali -->
    <div>
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Edit Buku</h1>
        <p class="text-stone-600 mt-1">Perbarui informasi data buku perpustakaan.</p>
        <div class="mt-3">
            <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-[#1E4D3B] hover:underline">
                ← Kembali ke daftar buku
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow-sm rounded-2xl border border-stone-200 overflow-hidden p-6 sm:p-8">
        <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-stone-700 mb-1">Judul Buku</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $book->judul) }}" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                @error('judul')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penulis -->
            <div>
                <label for="penulis" class="block text-sm font-medium text-stone-700 mb-1">Penulis</label>
                <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $book->penulis) }}" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                @error('penulis')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penerbit -->
            <div>
                <label for="penerbit" class="block text-sm font-medium text-stone-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $book->penerbit) }}"
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
            </div>

            <!-- Tahun Terbit & Stok (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="tahun_terbit" class="block text-sm font-medium text-stone-700 mb-1">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                        class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                </div>
                <div>
                    <label for="stok" class="block text-sm font-medium text-stone-700 mb-1">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', $book->stok) }}" min="0" required
                        class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                </div>
            </div>

            <!-- ISBN -->
            <div>
                <label for="isbn" class="block text-sm font-medium text-stone-700 mb-1">ISBN (Opsional)</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
            </div>

            <!-- Kategori -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-stone-700 mb-1">Kategori</label>
                <select name="category_id" id="category_id" 
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $book->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('books.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 text-stone-700 font-medium hover:bg-stone-50 transition text-sm">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#1E4D3B] text-white font-medium hover:bg-[#16382b] transition shadow-sm text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection