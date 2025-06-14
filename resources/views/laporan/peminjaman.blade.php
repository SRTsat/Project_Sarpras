@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

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
    .badge { /* Untuk badge status */
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.8rem;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Laporan Peminjaman</h4>
        <a href="{{ route('laporan.peminjaman.excel') }}" class="btn btn-light text-success">Export ke Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Peminjam</th>
                        <th>Barang</th>
                        <th>Tanggal Pinjam</th>
                        <th class="text-center">Jumlah Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                        <td>{{ $peminjaman->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                        <td class="text-center">{{ $peminjaman->jumlah_pinjam }}</td>
                        <td>
                            <span class="badge bg-{{ $peminjaman->status == 'disetujui' ? 'success' : ($peminjaman->status == 'ditolak' ? 'danger' : 'warning') }}">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center no-data py-4">
                            <i class="bi bi-clipboard-file-fill mb-3 d-block" style="font-size: 2rem;"></i>
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
