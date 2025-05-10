<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ApiPeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjam' => 'required|integer|min:1'
        ]);

        $data['status'] = 'menunggu';

        $peminjaman = Peminjaman::create($data);

        return response()->json([
            'message' => 'Permintaan peminjaman berhasil diajukan',
            'data' => $peminjaman
        ]);
    }

    public function riwayat()
    {
        $peminjamans = Peminjaman::where('status', '!=', 'menunggu')->get();

        return response()->json([
            'data' => $peminjamans
        ]);
    }
}
