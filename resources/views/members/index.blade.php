@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
    <h1>Daftar Member</h1>

    @if (session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-top: 16px; margin-bottom: 16px;">
            {{ session('success') }}
        </div>
    @endif

    <p><a href="{{ route('members.create') }}" style="display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px;">+ Tambah Member</a></p>

    <!-- Input Form Search (Poin 4) -->
    <form action="{{ route('members.index') }}" method="GET" style="margin-top: 16px; margin-bottom: 16px;">
        <input type="text" name="search" placeholder="Cari nama anggota..." value="{{ request('search') }}" style="padding: 6px; width: 250px;">
        <button type="submit" style="padding: 6px 12px;">Cari</button>
        @if(request('search'))
            <a href="{{ route('members.index') }}" style="margin-left: 8px; font-size: 14px;">Reset</a>
        @endif
    </form>

    <table style="border-collapse: collapse; width: 100%; margin-top: 16px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">ID</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">Nama</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">NIM</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">Email</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">Nomor Telepon</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">Alamat</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">Status</th>
                <th style="border: 1px solid #ccc; padding: 8px 12px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->id }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->nama }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->nim }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->email }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->nomor_telepon }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->alamat }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">{{ $member->status }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px 12px;">
                        <a href="{{ route('members.show', $member->id) }}">Detail</a>
                        |
                        <a href="{{ route('members.edit', $member->id) }}">Edit</a>
                        |
                        <form style="display: inline;" action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus member ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="border: 1px solid #ccc; padding: 8px 12px; text-align: center;">Belum ada data member.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links dengan Mempertahankan Query Search (Poin 4) -->
    <div style="margin-top: 16px;">
        {{ $members->appends(request()->query())->links() }}
    </div>
@endsection