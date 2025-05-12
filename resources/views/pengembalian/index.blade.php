@extends('layouts.app')
@section('title', 'Data Pengembalian')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pengembalian</h2>
    {{-- <a href="{{ route('pengembalians.create') }}" class="btn btn-primary">+ Tambah Pengembalian</a> --}}
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Pengembali</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Kembali</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pengembalians as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama_pengembali ?? '-' }}</td>
                <td>{{ $p->peminjaman->barang->nama_barang }}</td>
                <td>{{ $p->jumlah_kembali }}</td>
                <td>{{ $p->tanggal_kembali }}</td>
                <td>{{ $p->kondisi_barang }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Belum ada data pengembalian</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
