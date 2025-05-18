<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('kategori');
    
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
    
        $barangs = $query->get();
    
        return view('barang.index', compact('barangs'));
    }
    

    public function create()
    {
        $kategoris = KategoriBarang::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_barang,id',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Barang $barang)
    {
        $kategoris = KategoriBarang::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request ->validate([
            'kategori_id' => 'required|exists:kategori_barang,id',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                \Storage::disk('public')->delete($barang->foto);
            }

            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus');
    }
}
