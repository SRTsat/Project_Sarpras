@extends('layouts.app')
@section('title', 'Tambah Barang')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2 class="mb-3">Tambah Barang</h2>
<form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" class="form-select">
            @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Kondisi</label>
        <input type="text" name="kondisi" class="form-control">
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto Barang</label>
        <input type="file" class="form-control" name="foto" id="foto">
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection