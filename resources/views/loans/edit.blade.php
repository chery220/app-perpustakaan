@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 space-y-6">
    <!-- Header & Tombol Kembali -->
    <div>
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Edit Peminjaman</h1>
        <p class="text-stone-600 mt-1">Perbarui data transaksi peminjaman buku.</p>
        <div class="mt-3">
            <a href="{{ route('loans.index') }}" class="inline-flex items-center text-sm font-medium text-[#1E4D3B] hover:underline">
                ← Kembali ke daftar peminjaman
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow-sm rounded-2xl border border-stone-200 overflow-hidden p-6 sm:p-8">
        <form action="{{ route('loans.update', $loan->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Anggota -->
            <div>
                <label for="member_id" class="block text-sm font-medium text-stone-700 mb-1">Anggota</label>
                <select name="member_id" id="member_id" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm bg-white">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ (old('member_id', $loan->member_id) == $member->id) ? 'selected' : '' }}>
                            {{ $member->nama }} ({{ $member->nim }})
                        </option>
                    @endforeach
                </select>
                @error('member_id')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Petugas (Info Otomatis) -->
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Petugas Pencatat</label>
                <div class="w-full rounded-xl border border-stone-200 bg-stone-50 px-4 py-2.5 text-stone-600 text-sm">
                    {{ $loan->user->name ?? Auth::user()->name ?? 'Admin PENS' }} <span class="text-xs text-stone-400 italic">(petugas pencatat)</span>
                </div>
            </div>

            <!-- Tanggal Pinjam & Tanggal Kembali (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-medium text-stone-700 mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', $loan->tanggal_pinjam) }}" required
                        class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                    @error('tanggal_pinjam')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_kembali" class="block text-sm font-medium text-stone-700 mb-1">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $loan->tanggal_kembali) }}" required
                        class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                    @error('tanggal_kembali')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Peminjaman -->
            <div>
                <label for="status" class="block text-sm font-medium text-stone-700 mb-1">Status Peminjaman</label>
                <select name="status" id="status" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm bg-white">
                    @php $currentStatus = strtolower($loan->status); @endphp
                    <option value="Dipinjam" {{ (old('status', $currentStatus) == 'dipinjam') ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ (old('status', $currentStatus) == 'dikembalikan') ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="Terlambat" {{ (old('status', $currentStatus) == 'terlambat') ? 'selected' : '' }}>Terlambat</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buku yang Dipinjam (Checkboxes dengan buku yang sudah terpilih sebelumnya) -->
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Buku yang Dipinjam</label>
                <p class="text-xs text-stone-500 mb-2">Pilih buku yang termasuk dalam transaksi peminjaman ini.</p>
                
                @php
                    // Mengambil ID buku yang sedang dipinjam pada transaksi ini
                    $selectedBooks = old('books', isset($loan->loanItems) ? $loan->loanItems->pluck('book_id')->toArray() : []);
                @endphp

                <div class="max-h-60 overflow-y-auto rounded-xl border border-stone-300 p-4 space-y-2.5 bg-stone-50/50">
                    @foreach($books as $book)
                        <label class="flex items-center space-x-3 p-2 hover:bg-white rounded-lg transition cursor-pointer border border-transparent hover:border-stone-200">
                            <input type="checkbox" name="books[]" value="{{ $book->id }}" 
                                {{ in_array($book->id, $selectedBooks) ? 'checked' : '' }}
                                class="rounded border-stone-300 text-[#1E4D3B] focus:ring-[#1E4D3B] h-4 w-4">
                            <span class="text-sm text-stone-800 font-medium">{{ $book->judul }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-stone-200/70 text-stone-600 ml-auto">Stok: {{ $book->stok }}</span>
                        </label>
                    @endforeach
                </div>
                @error('books')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('loans.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 text-stone-700 font-medium hover:bg-stone-50 transition text-sm">
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