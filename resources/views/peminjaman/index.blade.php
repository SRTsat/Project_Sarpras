@extends('layouts.app')
@section('title', 'Data Peminjaman')

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
    .badge { /* Untuk badge status/kondisi */
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.8rem;
        font-weight: 500;
    }
    .btn-action {
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Permintaan Peminjaman</h4>
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
                        <th class="text-center">Jumlah</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                        <td>{{ $peminjaman->barang->nama_barang }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                        <td class="text-center">{{ $peminjaman->jumlah_pinjam }}</td>
                        <td>
                            <span class="badge bg-{{ $peminjaman->status == 'disetujui' ? 'success' : ($peminjaman->status == 'ditolak' ? 'danger' : 'warning') }}">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($peminjaman->status == 'menunggu')
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('peminjamans.approve', $peminjaman->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-success btn-action">Setujui</button>
                                    </form>
    
                                    <form action="{{ route('peminjamans.reject', $peminjaman->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-danger btn-action">Tolak</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('peminjamans.destroy', $peminjaman->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action delete-btn">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center no-data py-4">
                            <i class="bi bi-clipboard-x mb-3 d-block" style="font-size: 2rem;"></i>
                            Tidak ada permintaan peminjaman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data peminjaman akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7e57c2',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@endsection
