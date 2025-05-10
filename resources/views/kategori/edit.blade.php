@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
    <h3 class="mb-4">Edit Kategori</h3>
    <form action="{{ route('kategori-barangs.update', $kategori_barang->id) }}" method="POST">
    <a href="{{ route(name: 'kategori-barangs.index') }}" class="text-blue-400 hover:underline mb-4 inline-block">← Kembali</a>
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori_barang->nama_kategori }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
