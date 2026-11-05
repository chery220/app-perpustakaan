<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $loans = Loan::with(['member', 'user', 'loanItems.book'])->paginate(10);

    return view('loans.index', compact('loans'));
    }

    public function report(Request $request)
    {
        $body = ['data' => [], 'meta' => null];

        try {
            $response = Http::get(config('services.internal_api.base_url').'/api/loans', [
                'page' => $request->query('page', 1),
            ]);

            if ($response->successful()) {
                $body = $response->json();
            }
        } catch (ConnectionException $e) {
            // Server internal API (port 8011) tidak bisa dihubungi - tabel laporan tampil kosong.
        }

        return view('loans.report', [
            'loans' => $body['data'] ?? [],
            'meta' => $body['meta'] ?? null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('loans.create', compact('members', 'books'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'books' => 'required|array|min:1',
            'books*' => 'integer|exists:books,id',
            ]);

        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => auth()->id(),
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'dipinjam',
        ]);

        foreach ($validated['books'] as $bookId) {
            $loan->loanItems()->create(['book_id' => $bookId]);
        }

        // Kurangi stok buku secara otomatis
        $book = Book::find($bookId);
        if ($book && $book->stok > 0) {
            $book->stok -= 1;
            $book->save();
        }

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);
    return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $loan = Loan::with('loanItems')->findOrFail($id);
        $members = Member::all(); // <-- Pastikan baris ini ada
        $books = Book::all();     // <-- Pastikan baris ini juga ada

        return view('loans.edit', compact('loan', 'members', 'books'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

    $validated = $request->validate([
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required|in:dipinjam,dikembalikan,terlambat',
    ], [
        'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
        'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
    ]);

    $loan->update($validated);

    return redirect()->route('loans.index')
        ->with('success', 'Transaksi peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
    $loan->loanItems()->delete();
    $loan->delete();

    return redirect()->route('loans.index')
        ->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }
    
    public function kembalikan($id)
    {
        $loan = Loan::with('loanItems.book')->findOrFail($id);

        // Cek jika sebelumnya belum dikembalikan, kembalikan stok bukunya
        if (strtolower($loan->status) !== 'dikembalikan') {
            foreach ($loan->loanItems as $item) {
                if ($item->book) {
                    $item->book->stok += 1;
                    $item->book->save();
                }
            }
            $loan->status = 'dikembalikan';
            $loan->save();
        }

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan dan stok diperbarui!');
    }
    }
