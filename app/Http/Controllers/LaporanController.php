<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangExport;
use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;

class LaporanController extends Controller
{
    // === View ===
    public function barang()
    {
        $barangs = Barang::all();
        return view('laporan.barang', compact('barangs'));
    }

    public function peminjaman()
    {
        $peminjamans = Peminjaman::with('barang')->get();
        return view('laporan.peminjaman', compact('peminjamans'));
    }

    public function pengembalian()
    {
        $pengembalians = Pengembalian::with('peminjaman.barang')->get();
        return view('laporan.pengembalian', compact('pengembalians'));
    }

    // === Export Excel ===
    public function exportBarangExcel()
    {
        return Excel::download(new BarangExport, 'laporan-barang.xlsx');
    }

    public function exportPeminjamanExcel()
    {
        return Excel::download(new PeminjamanExport, 'laporan-peminjaman.xlsx');
    }

    public function exportPengembalianExcel()
    {
        return Excel::download(new PengembalianExport, 'laporan-pengembalian.xlsx');
    }
}
