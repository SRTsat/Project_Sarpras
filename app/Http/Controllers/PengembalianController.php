<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.barang')->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
       
        //$peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        //return view('pengembalian.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi_barang' => 'required',
            'nama_pengembalian' => 'required|string|max:100',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $barang = $peminjaman->barang;

       
        $barang->increment('jumlah', $request->jumlah_kembali);
        $peminjaman->update(['status' => 'dikembalikan']);

       
        Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_kembali' => $request->jumlah_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'nama_pengembali' => $request->nama_pengembali,
        ]);

        return redirect()->route('pengembalians.index')->with('success', 'Pengembalian berhasil disimpan');
    }
}

