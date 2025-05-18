@extends('layouts.app')
@section('title', 'Data Kategori')

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(45deg, #7e57c2, #5e35b1);
        color: white;
        padding: 15px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h3 {
        margin: 0;
        font-weight: 600;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead {
        background-color: #f0f3f7;
        color: #5e35b1;
    }

    .btn-tambah {
        background: linear-gradient(45deg, #7e57c2, #5e35b1);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 0.9;
    }

    .btn-edit {
        background-color: #ffc107;
        color: white;
        border: none;
    }

    .btn-hapus {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(126, 87, 194, 0.05);
    }

    .table-striped tbody tr:hover {
        background-color: rgba(126, 87, 194, 0.1);
        transition: background-color 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="table-header">
        <h3>Data Kategori</h3>
        <a href="{{ route('kategori-barangs.create') }}" class="btn btn-tambah">+ Tambah Kategori</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success m-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama Kategori</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td class="text-center">
                            <a href="{{ route('kategori-barangs.edit', $item->id) }}" class="btn btn-sm btn-edit me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('kategori-barangs.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-sm btn-hapus" onclick="return confirm('Hapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Optional: tambahkan interaktivitas jika diperlukan
</script>
@endsection