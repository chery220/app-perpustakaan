@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="space-y-6">
    <!-- Header & Tombol Tambah -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1E4D3B]">Daftar Anggota</h1>
            <p class="text-stone-600 mt-1">Kelola data mahasiswa dan anggota perpustakaan yang terdaftar.</p>
        </div>
        <a href="{{ route('members.create') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl font-medium text-white bg-[#1E4D3B] hover:bg-[#16382b] transition shadow-sm text-sm">
            + Tambah Anggota
        </a>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Anggota -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-[#F4F0EA] text-[#1E4D3B] font-semibold border-b border-stone-200">
                        <th class="p-4">ID</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">NIM</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse ($members as $member)
                        <tr class="hover:bg-stone-50 transition">
                            <td class="p-4 font-medium text-stone-900">#{{ $member->id }}</td>
                            <td class="p-4 font-semibold text-[#1E4D3B]">{{ $member->nama }}</td>
                            <td class="p-4 text-stone-600">{{ $member->nim }}</td>
                            <td class="p-4 text-stone-600">{{ $member->email }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $member->status === 'Aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $member->status }}
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('members.show', $member->id) }}" class="text-xs font-medium text-blue-600 hover:underline">Detail</a>
                                <span class="text-stone-300">|</span>
                                <a href="{{ route('members.edit', $member->id) }}" class="text-xs font-medium text-amber-600 hover:underline">Edit</a>
                                <span class="text-stone-300">|</span>
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus anggota ini?')" class="text-xs font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-stone-500">Belum ada data anggota terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $members->links() }}
    </div>
</div>
@endsection