# Dokumentasi PERTEMUAN 9
## Dedicated REST API Perpustakaan Digital

Dokumentasi seluruh 11 endpoint REST API yang dibangun pada aplikasi Perpustakaan Digital Kampus.

---

## Ringkasan Endpoint

| No | Method | URL | Deskripsi | Body Request (JSON) | Status Sukses | Status Gagal |
|---:|:---:|:---|:---|:---|:---:|:---:|
| 1 | `GET` | `/api/books` | Menampilkan daftar seluruh buku (paginated) | - | `200 OK` | - |
| 2 | `POST` | `/api/books` | Menambah data buku baru | `{"judul": "...", "penulis": "...", "penerbit": "...", "tahun_terbit": 2024, "isbn": "...", "stok": 5, "category_id": 1}` | `201 Created` | `422 Unprocessable Content` |
| 3 | `GET` | `/api/books/{id}` | Menampilkan detail 1 buku | - | `200 OK` | `404 Not Found` |
| 4 | `PUT` | `/api/books/{id}` | Memperbarui data buku | `{"judul": "...", "penulis": "...", "penerbit": "...", "tahun_terbit": 2024, "isbn": "...", "stok": 5, "category_id": 1}` | `200 OK` | `422 Unprocessable Content` / `404 Not Found` |
| 5 | `DELETE` | `/api/books/{id}` | Menghapus data buku | - | `200 OK` | `404 Not Found` |
| 6 | `GET` | `/api/members` | Menampilkan daftar anggota (paginated) | - | `200 OK` | - |
| 7 | `GET` | `/api/members/{id}` | Menampilkan detail 1 anggota | - | `200 OK` | `404 Not Found` |
| 8 | `GET` | `/api/loans` | Menampilkan daftar transaksi peminjaman (paginated) | - | `200 OK` | - |
| 9 | `POST` | `/api/loans` | Membuat transaksi peminjaman baru | `{"member_id": 1, "book_ids": [1, 2]}` | `201 Created` | `422 Unprocessable Content` |
| 10 | `PUT` | `/api/loans/{id}/kembalikan` | Memproses pengembalian buku | - | `200 OK` | `400 Bad Request` / `404 Not Found` |
| 11 | `GET` | `/api/stats` | Menampilkan statistik perpustakaan | - | `200 OK` | - |

---

## Detail & Contoh Response

### 1. `GET /api/books`
- **Deskripsi:** Mengambil daftar buku.
- **Contoh Response Sukses (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "judul": "Laskar Pelangi",
      "penulis": "Andrea Hirata",
      "penerbit": "Bentang Pustaka",
      "tahun_terbit": 2005,
      "isbn": "9789793062792",
      "stok": 5,
      "kategori": {
        "id": 1,
        "nama_kategori": "Novel"
      }
    }
  ],
  "links": {
    "first": "[http://127.0.0.1:8000/api/books?page=1](http://127.0.0.1:8000/api/books?page=1)",
    "last": "[http://127.0.0.1:8000/api/books?page=2](http://127.0.0.1:8000/api/books?page=2)"
  },
  "meta": {
    "current_page": 1,
    "last_page": 2,
    "total": 20
  }
}
```

### 2. `POST /api/books`
- **Deskripsi:** Menambah data buku.
```json
{
  "judul": "Clean Code",
  "penulis": "Robert C. Martin",
  "penerbit": "Prentice Hall",
  "tahun_terbit": 2008,
  "isbn": "9780132350884",
  "stok": 3,
  "category_id": 4
}

- **Contoh Response Sukses (201 Created):**
```json
{
  "message": "Buku berhasil ditambahkan.",
  "data": {
    "id": 21,
    "judul": "Clean Code",
    "penulis": "Robert C. Martin",
    "penerbit": "Prentice Hall",
    "tahun_terbit": 2008,
    "isbn": "9780132350884",
    "stok": 3,
    "kategori": {
      "id": 4,
      "nama_kategori": "Teknologi"
    }
  }
}

- **Contoh Response Gagal (422 Unprocessable Content):**
```json
{
  "message": "The judul field is required.",
  "errors": {
    "judul": ["Field judul wajib diisi."]
  }
}
```

### 3. `GET /api/books/{id}`
- **Deskripsi:** : Detail 1 buku.
- **Contoh Response Sukses (200 OK):**
```json
{
  "data": {
    "id": 1,
    "judul": "Laskar Pelangi",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2005,
    "isbn": "9789793062792",
    "stok": 5,
    "kategori": {
      "id": 1,
      "nama_kategori": "Novel"
    }
  }
}

- **Contoh Response Gagal (404 Not Found):**
```json
{
  "message": "Record not found."
}
```

### 4. `PUT /api/books/{id}`
- **Deskripsi:** : Update buku.
- **Contoh Response Sukses (200 OK):**
```json
{
  "message": "Buku berhasil diperbarui.",
  "data": {
    "id": 1,
    "judul": "Laskar Pelangi (Edisi Revisi)",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2005,
    "isbn": "9789793062792",
    "stok": 7,
    "kategori": {
      "id": 1,
      "nama_kategori": "Novel"
    }
  }
}
```


### 5. `DELETE /api/books/{id}`
- **Deskripsi:** : Hapus buku.
- **Contoh Response Sukses (200 OK):**
```json
{
  "message": "Buku berhasil dihapus."
}
```

### 6. `GET /api/members`
- **Deskripsi:** : Daftar anggota.
- **Contoh Response Sukses (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "nama": "Chery Ardin",
      "nim": "3123500001",
      "email": "chery@pens.ac.id",
      "nomor_telepon": "081234567890",
      "status": "aktif"
    }
  ]
}
```

### 7. `GET /api/members/{id}`
- **Deskripsi:** : Detail anggota.
- **Contoh Response Sukses (200 OK):**
```json
{
  "data": {
    "id": 1,
    "nama": "Chery Ardin",
    "nim": "3123500001",
    "email": "chery@pens.ac.id",
    "nomor_telepon": "081234567890",
    "status": "aktif"
  }
}
```

### 8. `GET /api/loans`
- **Deskripsi:** : Daftar peminjaman.
- **Contoh Response Sukses (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "member": { "id": 1, "nama": "Chery Ardin" },
      "petugas": { "id": 1, "name": "Bambang Sutrisno" },
      "tanggal_pinjam": "2026-10-20",
      "tanggal_kembali": "2026-10-27",
      "tanggal_dikembalikan": null,
      "status": "dipinjam",
      "books": [
        { "id": 1, "judul": "Laskar Pelangi" }
      ]
    }
  ]
}
```

### 9. `POST /api/loans`
- **Deskripsi:** : Buat peminjaman baru.
- **Contoh Response Sukses (200 OK):**
```json
{
  "member_id": 1,
  "book_ids": [1]
}

{
  "message": "Peminjaman berhasil dicatat.",
  "data": {
    "id": 2,
    "member": { "id": 1, "nama": "Chery Ardin" },
    "status": "dipinjam"
  }
}
```

### 10. `PUT /api/loans/{id}/kembalikan`
- **Deskripsi:** : Memproses pengembalian buku (Endpoint yang tadi dites di Postman).
- **Contoh Response Sukses (200 OK):**
```json
{
  "data": {
    "id": 1,
    "member": { "id": 1, "nama": "Chery Ardin" },
    "petugas": { "id": 1, "name": "Bambang Sutrisno" },
    "tanggal_pinjam": "2026-10-20",
    "tanggal_kembali": "2026-10-27",
    "tanggal_dikembalikan": "2026-10-27",
    "status": "dikembalikan",
    "books": [
      { "id": 1, "judul": "Laskar Pelangi" }
    ]
  }
}

- **Contoh Response Gagal: (400 Bad Request)**
```json
{
  "message": "Peminjaman ini sudah dikembalikan sebelumnya."
}
```

### 11. `GET /api/stats`
- **Deskripsi:** : Menampilkan ringkasan statistik.
- **Contoh Response Sukses (200 OK):**
```json
{
  "total_buku": 20,
  "total_anggota": 15,
  "peminjaman_aktif": 3
}
```