@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 space-y-6">
    <!-- Header & Tombol Kembali -->
    <div>
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Edit Anggota</h1>
        <p class="text-stone-600 mt-1">Perbarui informasi data anggota perpustakaan.</p>
        <div class="mt-3">
            <a href="{{ route('members.index') }}" class="inline-flex items-center text-sm font-medium text-[#1E4D3B] hover:underline">
                ← Kembali ke daftar anggota
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow-sm rounded-2xl border border-stone-200 overflow-hidden p-6 sm:p-8">
        <form action="{{ route('members.update', $member->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-medium text-stone-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $member->nama) }}" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                @error('nama')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- NIM -->
            <div>
                <label for="nim" class="block text-sm font-medium text-stone-700 mb-1">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', $member->nim) }}" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                @error('nim')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email & Nomor Telepon (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}"
                        class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="telepon" class="block text-sm font-medium text-stone-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $member->telepon) }}"
                        class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">
                    @error('telepon')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-stone-700 mb-1">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3"
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm">{{ old('alamat', $member->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-stone-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-stone-900 focus:outline-none focus:ring-2 focus:ring-[#1E4D3B] focus:border-transparent text-sm bg-white">
                    <option value="aktif" {{ (old('status', strtolower($member->status)) == 'aktif') ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak aktif" {{ (old('status', strtolower($member->status)) == 'tidak aktif') ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('members.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 text-stone-700 font-medium hover:bg-stone-50 transition text-sm">
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