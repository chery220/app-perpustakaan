@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header & Tombol Tambah -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1E4D3B]">Data Peminjaman</h1>
            <p class="text-stone-600 mt-1">Pantau transaksi peminjaman dan pengembalian buku perpustakaan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('loans.report') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl font-medium text-[#1E4D3B] bg-[#F4F0EA] hover:bg-stone-200 transition shadow-sm text-sm">
                Lihat Laporan
            </a>
            <a href="{{ route('loans.create') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl font-medium text-white bg-[#1E4D3B] hover:bg-[#16382b] transition shadow-sm text-sm">
                + Tambah Peminjaman
            </a>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Peminjaman -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-[#F4F0EA] text-[#1E4D3B] font-semibold border-b border-stone-200">
                        <th class="p-4">ID</th>
                        <th class="p-4">Anggota</th>
                        <th class="p-4">Petugas</th>
                        <th class="p-4">Buku</th>
                        <th class="p-4">Tgl Pinjam</th>
                        <th class="p-4">Tgl Kembali</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse ($loans as $loan)
                        <tr class="hover:bg-stone-50 transition">
                            <!-- 1. Kolom ID -->
                            <td class="p-4 font-medium text-stone-900">#{{ $loan->id }}</td>
                            
                            <!-- 2. Kolom Anggota -->
                            <td class="p-4 font-semibold text-[#1E4D3B]">{{ $loan->member->nama ?? '-' }}</td>
                            
                            <!-- 3. Kolom Petugas -->
                            <td class="p-4 text-stone-600">{{ $loan->user->name ?? '-' }}</td>
                            
                            <!-- 4. Kolom Buku -->
                            <td class="p-4 text-stone-600 max-w-xs">
                                @if(isset($loan->loanItems) && $loan->loanItems->count() > 0)
                                    @foreach($loan->loanItems as $item)
                                        <span class="inline-block bg-stone-100 px-2 py-0.5 rounded text-xs mr-1 mb-1">{{ $item->book->judul ?? '-' }}</span>
                                    @endforeach
                                @else
                                    <span class="text-stone-400 italic text-xs">Tidak ada buku</span>
                                @endif
                            </td>
                            
                            <!-- 5. Kolom Tgl Pinjam -->
                            <td class="p-4 text-stone-600">{{ $loan->tanggal_pinjam }}</td>
                            
                            <!-- 6. Kolom Tgl Kembali -->
                            <td class="p-4 text-stone-600">{{ $loan->tanggal_kembali }}</td>
                            
                            <!-- 7. Kolom Status -->
                            <td class="p-4 flex items-center justify-between gap-3">
                            <div>
                                @php $status = strtolower($loan->status); @endphp
                                @if($status === 'dipinjam')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Dipinjam</span>
                                @elseif($status === 'dikembalikan')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Dikembalikan</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                                @endif
                            </div>

                            <!-- Tombol Kembalikan Otomatis (Hanya muncul jika statusnya 'dipinjam') -->
                            @if($status === 'dipinjam')
                                <form action="{{ route('loans.kembalikan', $loan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Yakin ingin memproses pengembalian buku ini? Stok akan otomatis bertambah.')" 
                                        class="px-3 py-1.5 bg-[#1E4D3B] text-white rounded-xl text-xs font-medium hover:bg-[#16382b] transition shadow-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            @endif
                        </td>
                            
                            <!-- 8. Kolom Aksi -->
                            <td class="p-4 text-center space-x-2 whitespace-nowrap">
                                @if($status === 'dipinjam' || $status === 'terlambat')
                                    <form action="{{ route('loans.kembalikan', $loan->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-xs font-medium text-emerald-700 hover:underline">Kembalikan</button>
                                    </form>
                                    <span class="text-stone-300">|</span>
                                @endif
                                <a href="{{ route('loans.show', $loan->id) }}" class="text-xs font-medium text-blue-600 hover:underline">Detail</a>
                                <span class="text-stone-300">|</span>
                                <a href="{{ route('loans.edit', $loan->id) }}" class="text-xs font-medium text-amber-600 hover:underline">Edit</a>
                                <span class="text-stone-300">|</span>
                                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')" class="text-xs font-medium text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-stone-500">
                                Belum ada riwayat peminjaman buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $loans->links() }}
    </div>
</div>
@endsection