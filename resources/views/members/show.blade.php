@extends('layouts.app')

@section('title', 'Detail Member')

@section('content')
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar member</a></p>

    <h1>Detail Member: {{ $member->nama }}</h1>

    <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 6px; max-width: 600px; margin-top: 1rem;">
        <p><strong>ID:</strong> {{ $member->id }}</p>
        <p><strong>Nama:</strong> {{ $member->nama }}</p>
        <p><strong>NIM:</strong> {{ $member->nim }}</p>
        <p><strong>Email:</strong> {{ $member->email }}</p>
        <p><strong>Nomor Telepon:</strong> {{ $member->nomor_telepon }}</p>
        <p><strong>Alamat:</strong> {{ $member->alamat }}</p>
        <p><strong>Status:</strong> 
            <span style="padding: 2px 8px; border-radius: 4px; background: {{ $member->status == 'aktif' ? '#dcfce7' : '#fee2e2' }}; color: {{ $member->status == 'aktif' ? '#166534' : '#991b1b' }}; font-weight: bold;">
                {{ ucfirst($member->status) }}
            </span>
        </p>
    </div>

    <div style="margin-top: 1.5rem; display: flex; gap: 10px;">
        <a href="{{ route('members.edit', $member->id) }}" style="padding: 8px 16px; background: #eab308; color: #fff; text-decoration: none; border-radius: 4px;">Edit Member</a>
        
        <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="padding: 8px 16px; background: #dc2626; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Hapus Member</button>
        </form>
    </div>
@endsection