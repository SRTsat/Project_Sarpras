@extends('layouts.app')
@section('title', 'Data Barang')
@section('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.05);
        transition: background-color 0.3s ease;
    }

    .btn-action {
        margin-right: 5px;
        margin-bottom: 5px;
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
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    <form action="{{ route('barangs.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request('search') }}">
    </form>
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Barang</h4>
        <a href="{{ route('barangs.create') }}" class="btn btn-light text-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Barang
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th class="text-center">Jumlah</th>
                        <th>Kondisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            @if($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="img-thumbnail">
                            @else
                            <span class="badge bg-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td class="text-center">{{ $barang->jumlah }}</td>
                        <td>
                            <span class="badge 
                                {{ $barang->kondisi == 'Baik' ? 'bg-success' : 
                                   ($barang->kondisi == 'Rusak' ? 'bg-danger' : 'bg-warning') }}">
                                {{ $barang->kondisi }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-warning btn-action">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action delete-btn">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center no-data py-4">
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data barang akan dihapus permanen!",
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