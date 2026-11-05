@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 space-y-6">
    <!-- Header & Tombol Kembali -->
    <div>
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Detail Buku</h1>
        <p class="text-stone-600 mt-1">Informasi lengkap mengenai data buku perpustakaan.</p>
        <div class="mt-3">
            <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-[#1E4D3B] hover:underline">
                ← Kembali ke daftar buku
            </a>
        </div>
    </div>

    <!-- Tabel Informasi Detail Buku -->
    <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-stone-200">
        <table class="w-full text-left border-collapse">
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B] w-1/3">Judul</th>
                <td class="py-3.5 px-6 text-stone-900 font-medium">{{ $book->judul }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Penulis</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $book->penulis }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Penerbit</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $book->penerbit ?? '-' }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Tahun Terbit</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $book->tahun_terbit ?? '-' }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">ISBN</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $book->isbn ?? '-' }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Stok</th>
                <td class="py-3.5 px-6">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                        {{ $book->stok }} Pcs
                    </span>
                </td>
            </tr>
            <tr>
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Kategori</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $book->category->nama ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection