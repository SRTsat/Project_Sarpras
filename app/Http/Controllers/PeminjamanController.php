<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }


    

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjamans.index')->with('success', 'Data peminjaman berhasil dihapus');
    }

    public function approve(Peminjaman $peminjaman)
    {
        if ($peminjaman->status != 'menunggu') {
            return back()->with('error', 'Permintaan sudah diproses.');
        }

        $barang = $peminjaman->barang;
        if ($barang->jumlah < $peminjaman->jumlah_pinjam) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        //$barang->decrement('jumlah', $peminjaman->jumlah_pinjam);
        $peminjaman->update(['status' => 'disetujui']); 

        return back()->with('success', 'Permintaan disetujui.');
    }

    public function reject(Peminjaman $peminjaman)
    {
        if ($peminjaman->status != 'menunggu') {
            return back()->with('error', 'Permintaan sudah diproses.');
        }

        $peminjaman->update(['status' => 'ditolak']);
        return back()->with('success', 'Permintaan ditolak.');
    }
}
