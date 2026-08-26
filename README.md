# App Perpustakaan

Aplikasi manajemen perpustakaan berbasis Laravel 12 yang dirancang untuk mengelola data buku, peminjaman, dan anggota perpustakaan secara efisien.

## Cara Menjalankan Project Secara Lokal
1. Clone repository ini:
   git clone https://github.com/chery220/app-perpustakaan.git
2. Masuk ke folder project:
   cd app-perpustakaan
3. Install dependency:
   composer install
4. Salin file environment dan atur koneksi database PostgreSQL di `.env`:
   cp .env.example .env
5. Jalankan migrasi database:
   php artisan migrate
6. Jalankan server lokal:
   php artisan serve

## Perbedaan Model, View, dan Controller (MVC)
Model bertanggung jawab untuk mengelola data dan berinteraksi langsung dengan database PostgreSQL. View bertugas menampilkan antarmuka visual (UI) kepada pengguna menggunakan Blade template. Sementara Controller bertindak sebagai jembatan yang menerima permintaan pengguna, memproses logika aplikasi melalui Model, dan mengembalikan hasilnya ke View.

## Model (Data dan Logika Bisnis)
 Fungsi: Mengatur, menyimpan, mengambil, dan memanipulasi data dari database. Bagian ini juga memuat aturan logika bisnis aplikasi (seperti validasi data atau perhitungan).
 Karakteristik: Tidak tahu menahu tentang bagaimana data tersebut ditampilkan ke pengguna.
 Contoh: Skrip yang mengambil data daftar harga produk atau menyimpan data pengguna baru ke database.

 ## View (Antarmuka Pengguna)
 Fungsi: Menampilkan informasi dan antarmuka (UI) agar bisa dilihat dan dibaca oleh pengguna.
 Karakteristik: Hanya bertugas menyajikan data dari Model tanpa memproses logika pemrograman atau aturan bisnis.
 Contoh: Halaman web HTML, tabel, tombol, atau formulir penelusuran.

 ## Controller (Jembatan / Pengatur Alur)
 Fungsi: Menerima permintaan (request) dari pengguna, lalu mengatur alur komunikasi antara Model dan View.
 Karakteristik: Mengambil input dari pengguna (melalui View), meminta data ke Model jika diperlukan, lalu mengembalikan hasilnya kembali ke View untuk ditampilkan.
 Contoh: Saat tombol "Login" ditekan, Controller menerima data tersebut, memerintahkan Model untuk mencocokkan sandi, lalu mengarahkan tampilan ke halaman utama atau pesan error.