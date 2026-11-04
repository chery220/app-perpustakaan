# Skenario Demo UAS - Aplikasi Perpustakaan Digital

Dokumen ini berisi urutan langkah-langkah untuk mendemonstrasikan sistem aplikasi Perpustakaan Digital.

## Urutan Skenario Demo
1. **Login Aplikasi**: Akses `http://127.0.0.1:8000/login` dan login menggunakan kredensial admin (`admin@pens.ac.id` / `password`). Pastikan diarahkan ke halaman Dashboard dan nama admin tampil di navbar.
2. **Dashboard**: Tunjukkan halaman utama (`/`) yang memuat 3 kartu statistik (total buku, total anggota, dan peminjaman aktif).
3. **Manajemen Kategori**: Tambah kategori buku baru melalui menu kategori (khusus admin).
4. **Manajemen Buku**: Tambah data buku baru melalui menu `/books`, pastikan data menggunakan format Indonesia.
5. **Manajemen Anggota**: Periksa data anggota pada menu `/members`.
6. **Transaksi Peminjaman**: Buat transaksi peminjaman baru melalui menu `/loans`.
7. **Daftar Peminjaman Aktif & Pengembalian**: Tunjukkan daftar peminjaman aktif, lalu klik tombol pengembalian buku (`/loans/{id}/kembalikan`).
8. **Laporan Peminjaman**: Buka menu "Lihat Laporan Peminjaman" (`/loans/report`) untuk melihat rekap data transaksi lengkap.
9. **Demo API di Postman**: Uji beberapa *endpoint* REST API utama (seperti `GET /api/books`, `POST /api/loans`, dan `GET /api/stats`) menggunakan aplikasi Postman.