@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<h3 class="mb-4">Tambah Kategori</h3>
<form action="{{ route('kategori-barangs.store') }}" method="POST">
    <a href="{{ route(name: 'kategori-barangs.index') }}" class="text-blue-400 hover:underline mb-4 inline-block">← Kembali</a>
    @csrf
    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection