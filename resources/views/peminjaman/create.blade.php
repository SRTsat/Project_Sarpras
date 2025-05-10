@extends('layouts.app')
@section('title', 'Tambah Peminjaman')
@section('content')
<h2 class="mb-3">Tambah Peminjaman</h2>
<form action="{{ route('peminjamans.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="barang_id" class="form-label">Pilih Barang</label>
        <select name="barang_id" class="form-select">
            @foreach ($barangs as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama_barang }} (Stok: {{ $barang->jumlah }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Peminjam</label>
        <input type="text" name="nama_peminjam" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Pinjam</label>
        <input type="number" name="jumlah_pinjam" class="form-control">
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
