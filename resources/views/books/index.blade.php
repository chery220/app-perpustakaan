@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="space-y-6">
    <!-- Header Daftar Buku dengan Search Full Width -->
    <div class="bg-white shadow-sm rounded-2xl border border-stone-200 p-6 sm:p-8 mb-6 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#1E4D3B]">Daftar Buku</h1>
                <p class="text-stone-600 mt-1">Kelola inventaris dan katalog buku perpustakaan.</p>
            </div>
            
            <!-- Tombol Tambah Buku -->
            <a href="{{ route('books.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-medium text-white bg-[#1E4D3B] hover:bg-[#16382b] transition shadow-sm text-sm shrink-0">
                + Tambah Buku
            </a>
        </div>

        <!-- Form Pencarian Full Width -->
        <form action="{{ route('books.index') }}" method="GET" class="flex items-center gap-2 pt-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau penulis buku..." 
                class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4D3B]">
            
            <button type="submit" class="px-5 py-2.5 bg-[#1E4D3B] text-white rounded-xl text-sm font-medium hover:bg-[#16382b] transition shrink-0">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('books.index') }}" class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl text-sm font-medium hover:bg-stone-50 transition shrink-0 flex items-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Daftar Buku -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-[#F4F0EA] text-[#1E4D3B] font-semibold border-b border-stone-200">
                        <th class="p-4">ID</th>
                        <th class="p-4">Judul</th>
                        <th class="p-4">Penulis</th>
                        <th class="p-4">Penerbit</th>
                        <th class="p-4">Tahun</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse ($books as $book)
                        <tr class="hover:bg-stone-50 transition">
                            <td class="p-4 font-medium text-stone-900">#{{ $book->id }}</td>
                            <td class="p-4 font-semibold text-[#1E4D3B]">{{ $book->judul }}</td>
                            <td class="p-4 text-stone-600">{{ $book->penulis }}</td>
                            <td class="p-4 text-stone-600">{{ $book->penerbit }}</td>
                            <td class="p-4 text-stone-600">{{ $book->tahun_terbit }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $book->stok > 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $book->stok }} eks
                                </span>
                            </td>
                            <td class="p-4 text-stone-600">{{ $book->category->nama_kategori ?? '-' }}</td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('books.show', $book->id) }}" class="text-xs font-medium text-blue-600 hover:underline">Detail</a>
                                <span class="text-stone-300">|</span>
                                <a href="{{ route('books.edit', $book->id) }}" class="text-xs font-medium text-amber-600 hover:underline">Edit</a>
                                <span class="text-stone-300">|</span>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus buku ini?')" class="text-xs font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-stone-500">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection