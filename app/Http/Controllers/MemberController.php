<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest; // 1. Impor Request Class
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::when(request('search'), function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        // 2. Arahkan ke view form tambah data (members.create)
        return view('members.create');
    }
    
    public function store(StoreMemberRequest $request)
    {
        Member::create($request->validated());
        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.show', compact('member'));
    }

    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'nim'           => 'required|string|unique:members,nim,' . $member->id,
            'email'         => 'required|email|unique:members,email,' . $member->id,
            'nomor_telepon' => 'required|string|max:20',
            'alamat'        => 'required|string',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}