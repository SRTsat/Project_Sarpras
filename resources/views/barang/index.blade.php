@extends('layouts.app')
@section('title', 'Data Barang')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Barang</h2>
    <a href="{{ route('barangs.create') }}" class="btn btn-primary">+ Tambah Barang</a>
</div>
@if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($barangs as $barang)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" width="80">
                @else
                <span>Tidak ada foto</span>
                @endif
            </td>
            <td>{{ $barang->nama_barang }}</td> <!-- ini yang benar -->
            <td>{{ $barang->kategori->nama_kategori }}</td>
            <td>{{ $barang->jumlah }}</td>
            <td>{{ $barang->kondisi }}</td>
            <td>
                <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada data barang</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection