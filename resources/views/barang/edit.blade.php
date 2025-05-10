@extends('layouts.app')
@section('title', 'Edit Barang')
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
<h2 class="mb-3">Edit Barang</h2>
<form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" class="form-select">
            @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="{{ $barang->jumlah }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Kondisi</label>
        <input type="text" name="kondisi" class="form-control" value="{{ $barang->kondisi }}">
    </div>
    @if ($barang->foto)
    <img src="{{ asset('storage/' . $barang->foto) }}" width="150" class="mb-2">
    @endif
    <div class="mb-3">
        <label for="foto" class="form-label">Ganti Foto Barang</label>
        <input type="file" class="form-control" name="foto" id="foto">
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection