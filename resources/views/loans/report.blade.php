@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 space-y-6">
    <!-- Header & Deskripsi -->
    <div>
        <h1 class="text-2xl font-bold text-[#1E4D3B]">Laporan Peminjaman</h1>
        <!-- <p class="text-stone-600 mt-1">Data diambil secara dinamis melalui endpoint <code class="bg-stone-100 text-[#1E4D3B] px-2 py-0.5 rounded text-xs font-mono">GET /api/loans</code>.</p> -->
    </div>

    <!-- Tabel Laporan -->
    <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-stone-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F4F0EA] border-b border-stone-200 text-stone-700 text-sm">
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">ID</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Anggota</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Petugas</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Buku</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Tgl Pinjam</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Tgl Kembali</th>
                        <th class="py-3.5 px-4 font-semibold text-[#1E4D3B]">Status</th>
                    </tr>
                </thead>
                <tbody id="api-loans-table" class="divide-y divide-stone-100 text-sm">
                    <tr>
                        <td colspan="7" class="py-6 text-center text-stone-500 italic">Memuat data dari API...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Skrip JavaScript untuk Fetch API /api/loans -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('/api/loans')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('api-loans-table');
            tbody.innerHTML = '';

            // Menyesuaikan apakah data berbentuk array langsung atau dibungkus paginasi (data.data)
            let loans = Array.isArray(data) ? data : (data.data || []);

            if (loans.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="py-6 text-center text-stone-500 italic">Belum ada data peminjaman.</td></tr>`;
                return;
            }

            loans.forEach(loan => {
                // Ambil judul buku dari relasi loan_items / book
                let bookTitles = '-';
                if (loan.loan_items && loan.loan_items.length > 0) {
                    bookTitles = loan.loan_items.map(item => item.book ? item.book.judul : '-').join(', ');
                } else if (loan.books && loan.books.length > 0) {
                    bookTitles = loan.books.map(b => b.judul).join(', ');
                }

                let badgeClass = 'bg-stone-100 text-stone-800';
                let statusLower = (loan.status || '').toLowerCase();
                if (statusLower === 'dipinjam') badgeClass = 'bg-blue-100 text-blue-800';
                else if (statusLower === 'dikembalikan') badgeClass = 'bg-emerald-100 text-emerald-800';
                else if (statusLower === 'terlambat') badgeClass = 'bg-red-100 text-red-800';

                let row = `
                    <tr class="hover:bg-stone-50 transition">
                        <td class="py-3 px-4 text-stone-600 font-medium">#${loan.id}</td>
                        <td class="py-3 px-4 text-stone-900">${loan.member ? loan.member.nama : '-'}</td>
                        <td class="py-3 px-4 text-stone-600">${loan.user ? loan.user.name : '-'}</td>
                        <td class="py-3 px-4 text-stone-800">${bookTitles}</td>
                        <td class="py-3 px-4 text-stone-600">${loan.tanggal_pinjam}</td>
                        <td class="py-3 px-4 text-stone-600">${loan.tanggal_kembali}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full ${badgeClass}">${loan.status}</span>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Gagal mengambil data API:', error);
            document.getElementById('api-loans-table').innerHTML = `<tr><td colspan="7" class="py-6 text-center text-red-500 italic">Gagal memuat data dari endpoint API.</td></tr>`;
        });
});
</script>
@endsection