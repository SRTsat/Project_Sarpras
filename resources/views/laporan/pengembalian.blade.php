@extends('layouts.app')

@section('title', 'Laporan Pengembalian')

@section('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.05);
        transition: background-color 0.3s ease;
    }
    .card-header {
        background: linear-gradient(45deg, #7e57c2, #5e35b1);
        color: white;
    }
    .no-data {
        background-color: #f8f9fa;
        border: 1px dashed #7e57c2;
        color: #5e35b1;
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Laporan Pengembalian</h4>
        <a href="{{ route('laporan.pengembalian.excel') }}" class="btn btn-light text-success">Export ke Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Peminjam</th>
                        <th>Barang</th>
                        <th>Tanggal Kembali</th>
                        <th class="text-center">Jumlah Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengembalians as $pengembalian)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $pengembalian->nama_pengembali ?? '-' }}</td>
                        <td>{{ $pengembalian->peminjaman->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $pengembalian->tanggal_kembali }}</td>
                        <td class="text-center">{{ $pengembalian->jumlah_kembali }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center no-data py-4">
                            <i class="bi bi-arrow-return-left mb-3 d-block" style="font-size: 2rem;"></i>
                            Belum ada data pengembalian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
