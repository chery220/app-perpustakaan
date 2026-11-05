<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - Final Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9F6F0] text-stone-800 min-h-screen flex flex-col font-sans">

    <!-- Navbar Nuansa Dark Emerald -->
    <nav class="bg-[#1E4D3B] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <span class="text-xl font-bold tracking-wider text-mustard">📚 Perpustakaan</span>
                </div>
                <!-- Menu Navigasi -->
                <div class="hidden md:flex space-x-6 text-sm font-medium items-center">
                    <a href="{{ route('dashboard') }}" class="hover:text-[#E6B93B] transition">Dashboard</a>
                    <a href="{{ route('books.index') }}" class="hover:text-[#E6B93B] transition">Buku</a>
                    <a href="{{ route('members.index') }}" class="hover:text-[#E6B93B] transition">Anggota</a>
                    <a href="{{ route('loans.index') }}" class="hover:text-[#E6B93B] transition">Peminjaman</a>
                    <a href="{{ route('fines.index') }}" class="hover:text-[#E6B93B] transition">Denda</a>

                    <!-- Tombol Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="inline ml-4">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-semibold text-red-100 bg-red-700/60 hover:bg-red-700 transition shadow-sm">
                            Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </nav>
    

    <!-- Konten Utama -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Tempat card atau tabel konten kamu nantinya -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-emerald-dark text-white/80 py-4 text-center text-sm">
        <p>&copy; 2026 Final Project Pemrograman Framework - PENS</p>
    </footer>

</body>
</html>