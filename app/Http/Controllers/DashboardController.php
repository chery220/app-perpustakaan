<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
    $stats = [
            'total_buku' => Book::sum('stok') ?? Book::count(),
            'total_anggota' => Member::count(),
            'peminjaman_aktif' => Loan::whereRaw('LOWER(status) LIKE ?', ['%pinjam%'])->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
