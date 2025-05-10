@extends('layouts.app')
@section('title', 'Tambah Pengembalian')
@section('content')
<h2 class="mb-3">Form Pengembalian</h2>
<form action="{{ route('pengembalians.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Pilih Peminjaman</label>
        <select name="peminjaman_id" class="form-select">
            @foreach ($peminjamans as $p)
                <option value="{{ $p->id }}">
                    {{ $p->nama_peminjam }} - {{ $p->barang->nama_barang }} ({{ $p->jumlah_pinjam }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Kembali</label>
        <input type="number" name="jumlah_kembali" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Kondisi Barang</label>
        <input type="text" name="kondisi_barang" class="form-control">
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
