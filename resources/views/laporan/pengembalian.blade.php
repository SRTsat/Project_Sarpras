@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Pengembalian</h1>

  {{--  <a href="{{ route('laporan.pengembalian.excel') }}" class="btn btn-success mb-3">Export ke Excel</a> --}}

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $pengembalian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengembalian->nama_pengembali ?? '-' }}</td>
                <td>{{ $pengembalian->peminjaman->barang->nama_barang ?? '-' }}</td>
                <td>{{ $pengembalian->tanggal_kembali }}</td>
                <td>{{ $pengembalian->jumlah_kembali }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection