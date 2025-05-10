@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Peminjaman</h1>

   {{-- <a href="{{ route('laporan.peminjaman.excel') }}" class="btn btn-success mb-3">Export ke Excel</a> --}}

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Jumlah Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->nama_peminjam }}</td>
                <td>{{ $peminjaman->barang->nama_barang ?? '-' }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->jumlah_pinjam }}</td>
                <td>
                    <span class="badge bg-{{ $peminjaman->status == 'disetujui' ? 'success' : ($peminjaman->status == 'ditolak' ? 'danger' : 'warning') }}">
                        {{ ucfirst($peminjaman->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
