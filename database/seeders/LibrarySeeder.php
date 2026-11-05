<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Fine;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin untuk Login
        User::create([
            'name' => 'Admin PENS',
            'email' => 'admin@pens.ac.id',
            'password' => Hash::make('password'),
        ]);

        // 2. Kategori Buku (Wajib ada agar relasi buku tidak error)
        $kategoriList = [
            Category::create(['nama_kategori' => 'Pemrograman & Teknologi']),
            Category::create(['nama_kategori' => 'Novel & Fiksi']),
            Category::create(['nama_kategori' => 'Pengembangan Diri']),
            Category::create(['nama_kategori' => 'Sains & Pengetahuan']),
            Category::create(['nama_kategori' => 'Sejarah & Biografi']),
        ];

        // 3. Data Buku
        $books = [];
        $daftarBuku = [
            // Akademik / Teknologi
            ['judul' => 'Pemrograman Framework Laravel', 'penulis' => 'Tim Dosen PENS', 'penerbit' => 'PENS Press'],
            ['judul' => 'Algoritma & Struktur Data Java', 'penulis' => 'Chery Ardin', 'penerbit' => 'Dark Emerald Publisher'],
            ['judul' => 'Jaringan Komputer Lanjut', 'penulis' => 'Andi Prasetio', 'penerbit' => 'Informatika'],
            
            // Fiksi / Novel
            ['judul' => 'Pulang - Pergi', 'penulis' => 'Tere Liye', 'penerbit' => 'Sabak Pustaka'],
            ['judul' => 'Hujan', 'penulis' => 'Tere Liye', 'penerbit' => 'Gramedia Pustaka Utama'],
            ['judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'penerbit' => 'Kompas'],
            ['judul' => 'Atomic Habits', 'penulis' => 'James Clear', 'penerbit' => 'Gramedia Pustaka Utama'],
            ['judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'penerbit' => 'Lentera Dipantara'],
            ['judul' => 'Garis Waktu', 'penulis' => 'Fiersa Besari', 'penerbit' => 'Mediakita'],
            ['judul' => 'Sejarah Dunia yang Disembunyikan', 'penulis' => 'Jonathan Black', 'penerbit' => 'Alvabet'],
            ['judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship', 'penulis' => 'Robert C. Martin', 'penerbit' => 'Prentice Hall'],
            ['judul' => 'Sapiens: Riwayat Singkat Umat Manusia', 'penulis' => 'Yuval Noah Harari', 'penerbit' => 'KPG'],
            ['judul' => 'Laut Bercerita', 'penulis' => 'Leila S. Chudori', 'penerbit' => 'KPG'],
            ['judul' => 'Sebuah Seni untuk Bersikap Bodo Amat', 'penulis' => 'Mark Manson', 'penerbit' => 'Grasindo'],
            ['judul' => 'Logika Pemrograman Python', 'penulis' => 'Rian Hidayat', 'penerbit' => 'PENS Press'],
        ];

        foreach ($daftarBuku as $buku) {
            $books[] = Book::create([
                'judul' => $buku['judul'],
                'penulis' => $buku['penulis'],
                'penerbit' => $buku['penerbit'],
                'tahun_terbit' => rand(2020, 2026),
                'stok' => rand(5, 20),
                'category_id' => $kategoriList[array_rand($kategoriList)]->id,
            ]);
        }

        // 4. Data Anggota
        $members = [];
        $names = [
            'Ken Rosenbaum', 'Hoyt Heathcote', 'Jasen Hill', 'Elta Pouros', 
            'Elinore Lockman', 'Judson Abshire', 'Chery Ardin', 'Budi Santoso', 
            'Siti Aminah', 'Ahmad Dani', 'Dewi Lestari', 'Rian D\'Masiv', 
            'Tulus', 'Raisa Andriana', 'Isyana Sarasvati'
        ];
        
        foreach ($names as $index => $nama) {
            $members[] = Member::create([
                'nama' => $nama,
                'nim' => '31245000' . str_pad($index + 1, 2, '0', STR_PAD_LEFT),
                'email' => 'mhs' . ($index + 1) . '@pens.ac.id',
                'alamat' => 'Surabaya',
                'status' => 'aktif',
            ]);
        }

        // 5. Data Peminjaman (Loans)
        for ($i = 1; $i <= 12; $i++) {
            $loan = Loan::create([
                'member_id' => $members[array_rand($members)]->id,
                'user_id' => 1,
                'tanggal_pinjam' => Carbon::now()->subDays(rand(5, 20)),
                'tanggal_kembali' => Carbon::now()->addDays(rand(1, 7)),
                'status' => $i % 2 == 0 ? 'dipinjam' : 'terlambat', 
            ]);

            // Hubungkan buku ke peminjaman lewat LoanItem
            \App\Models\LoanItem::create([
                'loan_id' => $loan->id,
                'book_id' => $books[array_rand($books)]->id,
            ]);

            // Hubungkan ke buku jika ada relasinya
            if (method_exists($loan, 'books')) {
                $loan->books()->sync([$books[array_rand($books)]->id]);
            }

            // Jika statusnya terlambat, otomatis buatkan data denda
            if ($loan->status === 'terlambat') { 
                Fine::create([
                    'loan_id' => $loan->id,
                    'days_late' => rand(2, 10),
                    'amount' => rand(10000, 50000),
                    'status' => 'unpaid',
                ]);
            }
        }
    }
}