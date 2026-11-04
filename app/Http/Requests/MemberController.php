<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        [
            'id' => 1,
            'nama' => 'Ahmad Dahlan',
            'nim' => '220101001',
            'email' => 'ahmad@gmail.com',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Surabaya',
            'status' => 'aktif'
        ],
        [
            'id' => 2,
            'nama' => 'Siti Nurhaliza',
            'nim' => '220101002',
            'email' => 'siti@gmail.com',
            'nomor_telepon' => '089876543210',
            'alamat' => 'Sidoarjo',
            'status' => 'aktif'
        ],
    ];

    public function index()
    {
        $members = $this->members;
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }
}