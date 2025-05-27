@extends('layouts.app')
@section('title', 'Data Kategori')

@section('styles')
<style>
    /* Modern design system */
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

    /* Card styling */
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

    /* Table header styling */
    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 1.2rem 1.5rem;
        border-bottom: none;
    }

    /* Table styling */
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

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(126, 87, 194, 0.05);
    }

    .table-striped tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.08);
        transition: background-color 0.3s ease;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem;
        border-color: rgba(126, 87, 194, 0.1);
        color: black; /* Ensuring black text for table cells */
    }

    /* Button styling */
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

    .btn-tambah {
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        background: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-light);
        box-shadow: 0 4px 10px rgba(126, 87, 194, 0.15);
        transition: all 0.3s ease;
    }

    .btn-tambah:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(126, 87, 194, 0.2);
    }

    .btn-tambah i {
        margin-right: 0.5rem;
        font-size: 1.1rem;
        vertical-align: middle;
    }

    .btn-edit {
        background-color: var(--warning);
        border-color: var(--warning);
        color: white;
    }

    .btn-hapus {
        background-color: var(--danger);
        border-color: var(--danger);
        color: white;
    }

    /* Search input styling */
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

    /* Alert styling */
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

    /* No data styling */
    .no-data {
        background-color: var(--light-bg);
        border: 2px dashed rgba(126, 87, 194, 0.3);
        color: var(--primary-color);
        border-radius: 10px;
        padding: 2rem !important;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm animate-fade-in">
    <div class="search-container">
        <form method="GET" action="{{ route('kategori-barangs.index') }}">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Cari kategori berdasarkan nama...">
                <button class="btn btn-tambah" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-tags me-2"></i>Data Kategori</h4>
        <a href="{{ route('kategori-barangs.create') }}" class="btn btn-tambah">
            <i class="bi bi-plus-circle"></i>Tambah Kategori
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">No</th>
                        <th width="60%">Nama Kategori</th>
                        <th class="text-center" width="30%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->nama_kategori }}</strong></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('kategori-barangs.edit', $item->id) }}" class="btn btn-sm btn-warning btn-action me-2" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('kategori-barangs.destroy', $item->id) }}" method="POST" class="d-inline"> {{-- Removed .delete-form class --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action" title="Delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Data akan dihapus permanen.');"> {{-- Added onclick for native confirmation --}}
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center no-data py-5">
                            <i class="bi bi-tags mb-3 d-block" style="font-size: 3rem;"></i>
                            <p class="mb-1">Belum ada data kategori</p>
                            <small>Silahkan tambahkan kategori baru dengan klik tombol "Tambah Kategori"</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if(isset($kategoris) && count($kategoris) > 0)
    <div class="card-footer bg-white border-top-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">Menampilkan <strong>{{ count($kategoris) }}</strong> kategori</span>
            @if(method_exists($kategoris, 'links'))
                {{ $kategoris->links() }}
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
{{-- Removed all SweetAlert2 related JavaScript and CSS links for simple native confirmation --}}
@endsection