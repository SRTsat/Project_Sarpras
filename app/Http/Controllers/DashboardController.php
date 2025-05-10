<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        $total_kategori = KategoriBarang::count();
        $total_barang = Barang::count();
        $total_peminjaman = Peminjaman::count();
        $total_pengembalian = Pengembalian::count();

        return view('dashboard', compact('total_kategori', 'total_barang', 'total_peminjaman', 'total_pengembalian'));
    }
}

