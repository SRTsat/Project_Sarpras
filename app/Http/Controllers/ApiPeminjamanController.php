<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ApiPeminjamanController extends Controller
{
    public function store(Request $request)
    {

        \Log::info('DATA DARI FLUTTER:', $request->all());

        $data = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        
        $data['status'] = 'menunggu';
        $data['user_id'] = auth()->id(); // tetap simpan id user

       
        $peminjaman = Peminjaman::create($data);

        return response()->json([
            'message' => 'Permintaan peminjaman berhasil diajukan',
            'data' => $peminjaman
        ]);
    }

    public function riwayat()
    {
        $user = auth()->user();

        $peminjamans = Peminjaman::with('barang')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'menunggu')
            ->get();

        return response()->json([
            'data' => $peminjamans
        ]);
    }
}
