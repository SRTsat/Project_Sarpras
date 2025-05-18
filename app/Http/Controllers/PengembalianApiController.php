<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class PengembalianApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi_barang' => 'required|string',
            'nama_pengembali' => 'required|string|max:100',
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $barang = $peminjaman->barang;

        $barang->increment('jumlah', $request->jumlah_kembali);

        $peminjaman->update(['status' => 'dikembalikan']);

        if ($request->hasFile('foto_barang')) {
            $data['foto_barang'] = $request->file('foto_barang')->store('pengembalians', 'public');
        }

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_kembali' => $request->jumlah_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'nama_pengembali' => $request->nama_pengembali,
            'foto_barang' => $request->foto_barang,
        ]);

        return response()->json([
            'message' => 'Pengembalian berhasil',
            'data' => $pengembalian
        ]);
    }
}
