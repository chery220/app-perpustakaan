<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PorsiPas Perpus</title>
    <!-- Memuat Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 font-sans antialiased flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm p-6 bg-white border border-stone-200 rounded-lg shadow-sm">
        <!-- Judul Simpel Tanpa Logo & Tanpa Header Navbar -->
        <div class="mb-6">
            <h1 class="text-xl font-bold text-stone-800">Login Perpustakaan</h1>
            <p class="text-xs text-stone-500 mt-1">Masukkan akun untuk mengakses sistem.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-xs font-medium text-emerald-600 bg-emerald-50 p-3 rounded border border-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-xs font-semibold uppercase text-stone-600 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="w-full px-3 py-2 text-sm border border-stone-300 rounded focus:outline-none focus:border-[#1E4D3B] focus:ring-1 focus:ring-[#1E4D3B]">
                @error('email')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-xs font-semibold uppercase text-stone-600 mb-1.5">Password</label>
                <input type="password" name="password" required 
                    class="w-full px-3 py-2 text-sm border border-stone-300 rounded focus:outline-none focus:border-[#1E4D3B] focus:ring-1 focus:ring-[#1E4D3B]">
                @error('password')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center text-xs text-stone-600">
                <input type="checkbox" name="remember" id="remember" class="rounded border-stone-300 text-[#1E4D3B] focus:ring-[#1E4D3B] mr-2">
                <label for="remember">Ingat saya</label>
            </div>

            <!-- Tombol Aksi -->
            <button type="submit" class="w-full py-2 px-4 bg-[#1E4D3B] hover:bg-[#16382b] text-white text-sm font-medium rounded transition shadow-sm">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>