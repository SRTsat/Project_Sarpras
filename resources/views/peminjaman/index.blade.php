@extends('layouts.app')
@section('title', 'Data Peminjaman')

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

    .table-hover tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.08);
        transition: background-color 0.3s ease;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem;
        border-color: rgba(126, 87, 194, 0.1);
        color: black; /* Ensuring black text for table cells */
    }

    /* Badge styling */
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

    /* Button styling */
    .btn-action {
        margin-right: 6px;
        margin-bottom: 6px;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        background-color: var(--success);
        border-color: var(--success);
    }

    .btn-danger {
        background-color: var(--danger);
        border-color: var(--danger);
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

    .no-data i {
        font-size: 3rem !important;
        color: var(--primary-light);
        margin-bottom: 1rem;
        opacity: 0.7;
    }

    /* Button groups */
    .btn-group-action {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
    
    /* Date styling */
    .date-value {
        font-family: 'Roboto Mono', monospace;
        color: var(--text-dark);
    }
    
    /* Counter styling */
    .counter-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: var(--light-bg);
        color: var(--primary-dark);
        font-weight: 600;
        height: 28px;
        width: 28px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }
    
    /* Status label with icon */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 0.8rem;
    }
    
    .status-badge i {
        margin-right: 0.3rem;
    }
</style>
{{-- Link to Roboto Mono font is kept if you still want it for date styling --}}
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-clipboard-check me-2"></i>Daftar Permintaan Peminjaman</h4>
        <span class="badge bg-light text-primary">
            <i class="bi bi-list-check me-1"></i>
            Total: {{ count($peminjamans) }} permintaan
        </span>
    </div>

    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="20%">Nama Peminjam</th>
                        <th width="20%">Barang</th>
                        <th width="15%">Tanggal Pinjam</th>
                        <th class="text-center" width="8%">Jumlah</th>
                        <th width="12%">Status</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td><strong>{{ $peminjaman-> nama_peminjam }}</strong></td>
                        <td>{{ $peminjaman->barang->nama_barang }}</td>
                        <td class="date-value">{{ $peminjaman->tanggal_pinjam }}</td>
                        <td class="text-center">
                            <span class="fw-bold">{{ $peminjaman->jumlah_pinjam }}</span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $peminjaman->status == 'disetujui' ? 'success' : ($peminjaman->status == 'ditolak' ? 'danger' : 'warning') }} status-badge">
                                <i class="bi {{ $peminjaman->status == 'disetujui' ? 'bi-check-circle-fill' : ($peminjaman->status == 'ditolak' ? 'bi-x-circle-fill' : 'bi-hourglass-split') }}"></i>
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($peminjaman->status == 'menunggu')
                                <div class="btn-group-action">
                                    <form action="{{ route('peminjamans.approve', $peminjaman->id) }}" method="POST" class="d-inline"> {{-- Removed .approve-form class --}}
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-success btn-action"
                                                onclick="return confirm('Apakah Anda yakin ingin MENYETUJUI peminjaman ini?');"> {{-- Added onclick for native confirmation --}}
                                            <i class="bi bi-check-lg me-1"></i>Setujui
                                        </button>
                                    </form>
    
                                    <form action="{{ route('peminjamans.reject', $peminjaman->id) }}" method="POST" class="d-inline"> {{-- Removed .reject-form class --}}
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-danger btn-action"
                                                onclick="return confirm('Apakah Anda yakin ingin MENOLAK peminjaman ini?');"> {{-- Added onclick for native confirmation --}}
                                            <i class="bi bi-x-lg me-1"></i>Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('peminjamans.destroy', $peminjaman->id) }}" method="POST" class="d-inline"> {{-- Removed .delete-form class --}}
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini? Data akan dihapus permanen.');"> {{-- Added onclick for native confirmation --}}
                                        <i class="bi bi-trash-fill me-1"></i>Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center no-data py-5">
                            <i class="bi bi-clipboard-x mb-3 d-block"></i>
                            <p class="mb-1">Tidak ada permintaan peminjaman</p>
                            <small>Permintaan peminjaman yang dibuat akan muncul di sini</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if(isset($peminjamans) && count($peminjamans) > 0)
    <div class="card-footer bg-white border-top-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                <span class="badge bg-warning me-2">Menunggu: 
                    {{ $peminjamans->where('status', 'menunggu')->count() }}
                </span>
                <span class="badge bg-success me-2">Disetujui: 
                    {{ $peminjamans->where('status', 'disetujui')->count() }}
                </span>
                <span class="badge bg-danger me-2">Ditolak: 
                    {{ $peminjamans->where('status', 'ditolak')->count() }}
                </span>
            </div>
            @if(method_exists($peminjamans, 'links'))
                {{ $peminjamans->links() }}
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
{{-- All SweetAlert2 related JavaScript and CSS links have been removed for simple native confirmation --}}
@endsection