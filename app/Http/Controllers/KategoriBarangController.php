<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $kategori = KategoriBarang::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriBarang::create($request->all());

        return redirect()->route('kategori-barangs.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(KategoriBarang $kategori_barang)
    {
        return view('kategori.edit', compact('kategori_barang'));
    }

    public function update(Request $request, KategoriBarang $kategori_barang)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori_barang->update($request->all());

        return redirect()->route('kategori-barangs.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(KategoriBarang $kategori_barang)
    {
        $kategori_barang->delete();
        return redirect()->route('kategori-barangs.index')->with('success', 'Kategori berhasil dihapus');
    }
}
