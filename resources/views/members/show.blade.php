@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 space-y-6">
    <!-- Header & Tombol Kembali -->
    <div>
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Detail Anggota</h1>
        <p class="text-stone-600 mt-1">Informasi lengkap data anggota serta riwayat peminjaman buku.</p>
        <div class="mt-3">
            <a href="{{ route('members.index') }}" class="inline-flex items-center text-sm font-medium text-[#1E4D3B] hover:underline">
                ← Kembali ke daftar anggota
            </a>
        </div>
    </div>

    <!-- Tabel Informasi Detail Anggota -->
    <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-stone-200">
        <table class="w-full text-left border-collapse">
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B] w-1/3">Nama</th>
                <td class="py-3.5 px-6 text-stone-900 font-medium">{{ $member->nama }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">NIM</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $member->nim }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Email</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $member->email ?? '-' }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Nomor Telepon</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $member->telepon ?? '-' }}</td>
            </tr>
            <tr class="border-b border-stone-100">
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Alamat</th>
                <td class="py-3.5 px-6 text-stone-700">{{ $member->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <th class="py-3.5 px-6 bg-[#F4F0EA] font-semibold text-[#1E4D3B]">Status</th>
                <td class="py-3.5 px-6">
                    @php $status = strtolower($member->status); @endphp
                    @if($status === 'aktif')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                            Tidak Aktif
                        </span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Bagian Riwayat Peminjaman -->
    <div class="space-y-3 pt-4">
        <h2 class="text-xl font-bold text-[#1E4D3B]">Riwayat Peminjaman</h2>
        
        <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-stone-200">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F4F0EA] border-b border-stone-200 text-stone-700 text-sm">
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Tanggal Pinjam</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Tanggal Kembali</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Petugas</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Buku</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @forelse($member->loans as $loan)
                        <tr class="hover:bg-stone-50 transition">
                            <td class="py-3 px-4 text-stone-600">{{ $loan->tanggal_pinjam }}</td>
                            <td class="py-3 px-4 text-stone-600">{{ $loan->tanggal_kembali }}</td>
                            <td class="py-3 px-4 text-stone-600">{{ $loan->user->name ?? '-' }}</td>
                            <td class="py-3 px-4 text-stone-900">
                                @if(isset($loan->loanItems) && $loan->loanItems->count() > 0)
                                    @foreach($loan->loanItems as $item)
                                        <span class="inline-block bg-stone-100 px-2 py-0.5 rounded text-xs mr-1 mb-1">{{ $item->book->judul ?? '-' }}</span>
                                    @endforeach
                                @else
                                    <span class="text-stone-400 italic text-xs">Tidak ada buku</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @php $loanStatus = strtolower($loan->status); @endphp
                                @if($loanStatus === 'dipinjam')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Dipinjam</span>
                                @elseif($loanStatus === 'dikembalikan')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Dikembalikan</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-4 text-center text-stone-500 italic">
                                Anggota ini belum memiliki riwayat peminjaman buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection