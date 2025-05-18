@extends('layouts.app')
@section('title', 'Data Pengembalian')

@section('styles')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        background-color: white;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead {
        background: linear-gradient(45deg, #7e57c2, #5e35b1);
        color: white;
    }

    .table thead tr th {
        border: none;
        padding: 15px 12px;
        font-weight: 600;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.05);
    }

    .table tbody td {
        vertical-align: middle;
        padding: 15px 12px;
    }

    .empty-state {
        text-align: center;
        padding: 50px;
        color: #7e57c2;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(45deg, #7e57c2, #5e35b1); color: white;">
        <h4 class="mb-0">Data Pengembalian</h4>
        {{-- <a href="{{ route('pengembalians.create') }}" class="btn btn-light">+ Tambah Pengembalian</a> --}}
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengembali</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Foto Barang</th>
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
                    <td>
                        @if ($p->foto_barang)
                        <img src="{{ asset('storage/' . $p->foto_barang) }}" width="100">
                        @else
                        <span>-</span>
                        @endif
                    </td>
                    <td>{{ $p->tanggal_kembali }}</td>

                    <td>{{ $p->kondisi_barang }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <h5>Belum ada data pengembalian</h5>
                        <p>Tidak ada barang yang dikembalikan saat ini</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Optional: Tambahkan interaktivitas jika diperlukan
</script>
@endsection