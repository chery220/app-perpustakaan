@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#1E4D3B]">Daftar Denda Keterlambatan</h1>
            <p class="text-stone-600 mt-1">Kelola dan pantau status pembayaran denda peminjaman buku.</p>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Denda -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-[#F4F0EA] text-[#1E4D3B] font-semibold border-b border-stone-200">
                    <th class="p-4">ID</th>
                    <th class="p-4">ID Peminjaman</th>
                    <th class="p-4">Terlambat (Hari)</th>
                    <th class="p-4">Nominal Denda</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200">
                @forelse($fines as $fine)
                    <tr class="hover:bg-stone-50 transition">
                        <td class="p-4 font-medium text-stone-900">#{{ $fine->id }}</td>
                        <td class="p-4 text-stone-600">Peminjaman #{{ $fine->borrowing_id }}</td>
                        <td class="p-4 text-stone-600">{{ $fine->days_late }} Hari</td>
                        <td class="p-4 font-semibold text-[#1E4D3B]">Rp {{ number_format($fine->amount, 0, ',', '.') }}</td>
                        <td class="p-4">
                            @if($fine->status === 'paid')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Lunas</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Belum Bayar</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            @if($fine->status === 'unpaid')
                                <form action="{{ route('fines.pay', $fine->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-xs font-medium text-white bg-[#1E4D3B] hover:bg-[#16382b] rounded-xl transition shadow-sm">
                                        Bayar Denda
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-stone-400 font-medium">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-stone-500">
                            Belum ada data denda keterlambatan saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection