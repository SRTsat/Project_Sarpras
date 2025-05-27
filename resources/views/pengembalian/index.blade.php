@extends('layouts.app')
@section('title', 'Data Pengembalian')

@section('styles')
<style>
    /* Modern design system - Ensure these variables are defined for consistency */
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

    /* Card styling - Taken from Data Peminjaman */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(126, 87, 194, 0.1);
        transition: all 0.3s ease;
        background-color: white; /* Ensure it's white as per modern design */
    }
    
    .card:hover {
        box-shadow: 0 15px 35px rgba(126, 87, 194, 0.15);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 1.2rem 1.5rem;
        border-bottom: none;
        /* Added for header content alignment */
        display: flex; 
        justify-content: space-between;
        align-items: center;
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
        color: black; /* CHANGED: Was var(--text-dark), now pure black */
    }


    /* Badge styling - Taken from Data Peminjaman */
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

    /* No data styling - Taken from Data Peminjaman */
    .no-data {
        background-color: var(--light-bg);
        border: 2px dashed rgba(126, 87, 194, 0.3);
        color: var(--primary-color);
        border-radius: 10px;
        padding: 2rem !important;
        font-weight: 500;
        text-align: center; /* Ensure text is centered */
    }

    .no-data i {
        font-size: 3rem !important;
        color: var(--primary-light);
        margin-bottom: 1rem;
        opacity: 0.7;
        display: block; 
    }
    

    .table-img-thumbnail {
        width: 80px; 
        height: auto;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }

    .table-img-thumbnail:hover {
        transform: scale(1.05);
    }

    .date-value {
        font-family: 'Roboto Mono', monospace;
        color: var(--text-dark);
    }


     @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm"> {{-- Added shadow-sm class to card --}}
    <div class="card-header d-flex justify-content-between align-items-center"> {{-- Added classes for alignment --}}
        <h4 class="mb-0"><i class="bi bi-arrow-return-left me-2"></i>Data Pengembalian Barang</h4> {{-- Added icon --}}
        {{-- Total badge, consistent with Data Peminjaman page --}}
        <span class="badge bg-light text-primary">
            <i class="bi bi-list-check me-1"></i>
            Total: {{ count($pengembalians) }} pengembalian
        </span>
    </div>

    <div class="card-body p-0"> {{-- Added p-0 to remove default padding for table --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive"> {{-- Added table-responsive for better mobile view --}}
            <table class="table table-hover"> {{-- Added table-hover for row highlight --}}
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th> {{-- Added text-center and width --}}
                        <th width="20%">Nama Pengembali</th>
                        <th width="20%">Barang</th>
                        <th class="text-center" width="10%">Jumlah</th> {{-- Added text-center and width --}}
                        <th class="text-center" width="15%">Foto Barang</th> {{-- Added text-center and width --}}
                        <th width="15%">Tanggal Kembali</th>
                        <th width="15%">Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengembalians as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> {{-- Added text-center --}}
                        <td><strong>{{ $p->nama_pengembali ?? '-' }}</strong></td> {{-- Added strong tag --}}
                        <td>{{ $p->peminjaman->barang->nama_barang }}</td>
                        <td class="text-center">{{ $p->jumlah_kembali }}</td> {{-- Added text-center --}}
                        <td class="text-center"> {{-- Added text-center --}}
                            @if ($p->foto_barang)
                            <img src="{{ asset('storage/' . $p->foto_barang) }}" alt="Foto Barang" class="table-img-thumbnail"> {{-- Added class for styling --}}
                            @else
                            <span>-</span>
                            @endif
                        </td>
                        <td class="date-value">{{ $p->tanggal_kembali }}</td> {{-- Added class for styling --}}
                        <td>
                            {{-- Dynamic badge for kondisi_barang, consistent with Data Peminjaman status badges --}}
                            <span class="badge bg-{{ $p->kondisi_barang == 'Baik' ? 'success' : ($p->kondisi_barang == 'Rusak' ? 'danger' : 'warning') }}">
                                {{ ucfirst($p->kondisi_barang) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Used .no-data class for consistent empty state styling --}}
                        <td colspan="7" class="text-center no-data py-5">
                            <i class="bi bi-box-seam-fill mb-3 d-block"></i> {{-- Changed icon for relevance --}}
                            <p class="mb-1">Belum ada data pengembalian</p>
                            <small>Data pengembalian barang akan muncul di sini</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    {{-- Card Footer for pagination/summary --}}
    @if(isset($pengembalians) && count($pengembalians) > 0)
    <div class="card-footer bg-white border-top-0 py-3">
        <div class="d-flex justify-content-end align-items-center"> {{-- Adjust alignment if you have pagination --}}
            @if(method_exists($pengembalians, 'links'))
                {{ $pengembalians->links() }}
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
{{-- Include SweetAlert2 and Roboto Mono font links for consistency --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
@endsection