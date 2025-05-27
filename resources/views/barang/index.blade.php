@extends('layouts.app')
@section('title', 'Data Barang')
@section('styles')
<style>
    :root {
        --primary-color: #7e57c2;
        --primary-light: #b085f5;
        --primary-dark: #4d2c91;
        --accent-color: #ff6e40;
        --light-bg: #f5f3fc;
        --text-dark: #424242;
        --success: #4caf50;
        --warning: #ff9800;
        --danger: #f44336;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(126, 87, 194, 0.1);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 15px 35px rgba(126, 87, 194, 0.15);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 1.2rem 1.5rem;
        border-bottom: none;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        border-top: none;
        border-bottom: 2px solid var(--primary-light);
        font-weight: 600;
        color: var(--primary-dark);
        padding: 1rem;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.08);
        transition: background-color 0.3s ease;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem;
        border-color: rgba(126, 87, 194, 0.1);
        color: black;
    }

    .btn-action {
        margin-right: 6px;
        margin-bottom: 6px;
        border-radius: 8px;
        padding: 0.5rem;
        transition: all 0.3s ease;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-danger {
        background-color: #f44336;
        border-color: #f44336;
    }

    .img-thumbnail {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: 3px solid rgba(126, 87, 194, 0.1);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .img-thumbnail:hover {
        transform: scale(1.1) rotate(2deg);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .badge {
        padding: 0.5rem 0.8rem;
        font-weight: 500;
        border-radius: 6px;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .bg-success {
        background-color: var(--success) !important;
        box-shadow: 0 3px 5px rgba(76, 175, 80, 0.3);
    }

    .bg-warning {
        background-color: var(--warning) !important;
        box-shadow: 0 3px 5px rgba(255, 152, 0, 0.3);
    }

    .bg-danger {
        background-color: var(--danger) !important;
        box-shadow: 0 3px 5px rgba(244, 67, 54, 0.3);
    }

    .no-data {
        background-color: var(--light-bg);
        border: 2px dashed rgba(126, 87, 194, 0.3);
        color: var(--primary-color);
        border-radius: 10px;
        padding: 2rem !important;
        font-weight: 500;
    }

    .no-data i {
        font-size: 3rem !important;
        color: var(--primary-light);
        margin-bottom: 1rem;
        opacity: 0.7;
    }

    .search-container {
        padding: 1.5rem;
        background-color: white;
        border-bottom: 1px solid rgba(126, 87, 194, 0.1);
    }

    .search-input {
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        border: 2px solid rgba(126, 87, 194, 0.2);
        transition: all 0.3s ease;
        background-color: var(--light-bg);
    }

    .search-input:focus {
        box-shadow: 0 0 0 4px rgba(126, 87, 194, 0.15);
        border-color: var(--primary-color);
    }

    .btn-add {
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        background: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-light);
        box-shadow: 0 4px 10px rgba(126, 87, 194, 0.15);
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(126, 87, 194, 0.2);
    }

    .btn-add i {
        margin-right: 0.5rem;
        font-size: 1.1rem;
        vertical-align: middle;
    }

    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
        background-color: rgba(76, 175, 80, 0.1);
        color: #2e7d32;
        border-left: 4px solid #4caf50;
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm animate-fade-in">
    <div class="search-container">
        <form action="{{ route('barangs.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Cari barang berdasarkan nama, kategori, atau kondisi..." value="{{ request('search') }}">
                <button class="btn btn-add" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i>Data Barang</h4>
        <a href="{{ route('barangs.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i>Tambah Barang
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate-fade-in" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="15%">Foto</th>
                        <th width="20%">Nama Barang</th>
                        <th width="15%">Kategori</th>
                        <th class="text-center" width="10%">Jumlah</th>
                        <th width="15%">Kondisi</th>
                        <th class="text-center" width="20%">Aksi</th>
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
                        <td><strong>{{ $barang->nama_barang }}</strong></td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td class="text-center"><span class="fw-bold">{{ $barang->jumlah }}</span></td>
                        <td>
                            <span class="badge 
                                {{ $barang->kondisi == 'Baik' ? 'bg-success' : 
                                   ($barang->kondisi == 'Rusak' ? 'bg-danger' : 'bg-warning') }}">
                                <i class="bi {{ $barang->kondisi == 'Baik' ? 'bi-check-circle-fill' : 
                                                ($barang->kondisi == 'Rusak' ? 'bi-x-circle-fill' : 'bi-exclamation-circle-fill') }} me-1"></i>
                                {{ $barang->kondisi }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline"> {{-- Removed .delete-form class --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action" title="Delete" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini? Data akan dihapus permanen.');"> {{-- Added onclick for native confirmation --}}
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center no-data py-5">
                            <i class="bi bi-box-seam mb-3 d-block"></i>
                            <p class="mb-1">Belum ada data barang</p>
                            <small>Silahkan tambahkan barang baru dengan klik tombol "Tambah Barang"</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(isset($barangs) && count($barangs) > 0)
    <div class="card-footer bg-white border-top-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">Menampilkan <strong>{{ count($barangs) }}</strong> barang</span>
            @if(method_exists($barangs, 'links'))
                {{ $barangs->links() }}
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
{{-- Removed all SweetAlert2 related JavaScript and CSS links --}}
@endsection