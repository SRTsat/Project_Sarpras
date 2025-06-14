@extends('layouts.app')

@section('title', 'Laporan Barang') {{-- Tambahkan title untuk konsistensi --}}

@section('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.05);
        transition: background-color 0.3s ease;
    }
    .img-thumbnail {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
        <h4 class="mb-0">Laporan Barang</h4>
        Anda bisa menambahkan link export ke Excel di sini, jika diperlukan
        <a href="{{ route('laporan.barang.excel') }}" class="btn btn-light text-success">
            <i class="bi bi-file-excel me-2"></i>Export ke Excel
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            @if($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}"
                                     alt="{{ $barang->nama_barang }}"
                                     class="img-thumbnail">
                            @else
                                <span class="badge bg-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td class="text-center">{{ $barang->jumlah }}</td>
                        <td>{{ $barang->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center no-data py-4">
                                <i class="bi bi-box-seam mb-3 d-block" style="font-size: 2rem;"></i>
                                Belum ada data barang
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
