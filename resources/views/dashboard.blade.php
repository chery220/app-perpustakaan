@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header sambutan -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200">
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Dashboard</h1>
        <p class="text-stone-600 mt-1">Ringkasan statistik perpustakaan, diambil langsung dari sistem PorsiPas Perpus.</p>
    </div>

    <!-- Statistik Cards (Grid 3 Kolom) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Total Buku -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-stone-500 uppercase tracking-wider">Total Buku</p>
                <h3 class="text-3xl font-extrabold text-[#1E4D3B] mt-2">{{ $stats['total_buku'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#F4F0EA] flex items-center justify-center text-2xl">
                📚
            </div>
        </div>

        <!-- Card Total Anggota -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-stone-500 uppercase tracking-wider">Total Anggota</p>
                <h3 class="text-3xl font-extrabold text-[#1E4D3B] mt-2">{{ $stats['total_anggota'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#F4F0EA] flex items-center justify-center text-2xl">
                👥
            </div>
        </div>

        <!-- Card Peminjaman Aktif -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-stone-500 uppercase tracking-wider">Peminjaman Aktif</p>
                <h3 class="text-3xl font-extrabold text-[#1E4D3B] mt-2">{{ $stats['peminjaman_aktif'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#F4F0EA] flex items-center justify-center text-2xl">
                🔄
            </div>
        </div>
    </div>

    <!-- Tombol Aksi Cepat -->
    <div class="pt-4">
        <a href="{{ route('loans.report') }}" class="inline-flex items-center px-5 py-3 rounded-xl font-medium text-white bg-[#1E4D3B] hover:bg-[#16382b] transition shadow-md">
            Lihat Laporan Peminjaman &rarr;
        </a>
    </div>
</div>
@endsection