@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar member</a></p>

    <h1>Edit Member</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="nama" style="font-weight: bold; display: block;">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $member->nama) }}" style="width: 100%; padding: 6px; margin-top: 4px;">
            @error('nama')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="nim" style="font-weight: bold; display: block;">NIM</label>
            <input type="text" name="nim" id="nim" value="{{ old('nim', $member->nim) }}" style="width: 100%; padding: 6px; margin-top: 4px;">
            @error('nim')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email" style="font-weight: bold; display: block;">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" style="width: 100%; padding: 6px; margin-top: 4px;">
            @error('email')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="nomor_telepon" style="font-weight: bold; display: block;">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $member->nomor_telepon) }}" style="width: 100%; padding: 6px; margin-top: 4px;">
            @error('nomor_telepon')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="alamat" style="font-weight: bold; display: block;">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" style="width: 100%; padding: 6px; margin-top: 4px;">{{ old('alamat', $member->alamat) }}</textarea>
            @error('alamat')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="status" style="font-weight: bold; display: block;">Status</label>
            <select name="status" id="status" style="width: 100%; padding: 6px; margin-top: 4px;"> 
                <option value="">-- Pilih Status --</option>
                <option value="aktif" {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $member->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option> 
            </select>
            @error('status')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn" style="margin-top: 10px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Perbarui</button>
    </form>
@endsection