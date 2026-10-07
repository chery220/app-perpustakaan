<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 600px; }
        .alert { padding: 10px; background: #dcfce7; color: #15803d; border-radius: 4px; margin-bottom: 15px; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 6px; margin-bottom: 20px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .btn { margin-top: 20px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <p><a href="{{ route('books.index') }}">&larr; Kembali ke Beranda</a></p>

    <h1>Profil Saya</h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="card">
        <h3>Informasi Akun</h3>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <div class="card">
        <h3>Ganti Password</h3>
        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="current_password">Password Lama</label>
            <input type="password" name="current_password" id="current_password">
            @error('current_password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation">

            <button type="submit" class="btn">Perbarui Password</button>
        </form>
    </div>
</body>
</html>