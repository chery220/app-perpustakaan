<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    // Menampilkan daftar seluruh denda
    public function index()
    {
        $fines = Fine::with('loan')->latest()->get();
        return view('fines.index', compact('fines'));
    }

    // Mengubah status denda menjadi Lunas (Paid)
    public function markAsPaid($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Status denda berhasil diperbarui menjadi Lunas!');
    }
}
