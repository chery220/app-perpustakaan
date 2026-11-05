@extends('layouts.app') 

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-stone-900">Detail Peminjaman</h1>
        <a href="{{ route('loans.index') }}" class="text-sm text-emerald-600 hover:underline inline-block mt-1">
            ← Kembali ke daftar peminjaman
        </a>
    </div>

    <!-- Informasi Utama -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-stone-200 mb-8">
        <table class="w-full text-left border-collapse">
            <tr class="border-b border-stone-100">
                <th class="py-3 px-4 bg-stone-50 font-medium text-stone-700 w-1/3">Anggota</th>
                <td class="py-3 px-4 text-stone-900">{{ $loan->member->nama ?? '-' }} ({{ $loan->member->nim ?? '-' }})</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3 px-4 bg-stone-50 font-medium text-stone-700">Petugas</th>
                <td class="py-3 px-4 text-stone-900">{{ $loan->user->name ?? '-' }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3 px-4 bg-stone-50 font-medium text-stone-700">Tanggal Pinjam</th>
                <td class="py-3 px-4 text-stone-900">{{ $loan->tanggal_pinjam }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3 px-4 bg-stone-50 font-medium text-stone-700">Tanggal Kembali</th>
                <td class="py-3 px-4 text-stone-900">{{ $loan->tanggal_kembali }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3 px-4 bg-stone-50 font-medium text-stone-700">Tanggal Dikembalikan</th>
                <td class="py-3 px-4 text-stone-900">{{ $loan->tanggal_dikembalikan ?? '-' }}</td>
            </tr>
            <tr>
                <th class="py-3 px-4 bg-stone-50 font-medium text-stone-700">Status</th>
                <td class="py-3 px-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                        {{ $loan->status == 'terlambat' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Tabel Buku yang Dipinjam -->
    <h2 class="text-xl font-bold text-stone-900 mb-4">Buku yang Dipinjam</h2>
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-stone-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-stone-50 border-b border-stone-200">
                    <th class="py-3 px-4 font-semibold text-stone-700">Judul</th>
                    <th class="py-3 px-4 font-semibold text-stone-700">Penulis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loan->loanItems as $item)
                <tr class="border-b border-stone-100">
                    <td class="py-3 px-4 text-stone-900">{{ $item->book->judul ?? '-' }}</td>
                    <td class="py-3 px-4 text-stone-600">{{ $item->book->penulis ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="py-4 px-4 text-center text-stone-500">Tidak ada buku yang terlampir.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection