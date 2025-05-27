@extends('layouts.app')
@section('title', 'Edit Kategori')

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

    /* Card Header styling */
    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 1.2rem 1.5rem;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Form control styling */
    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(126, 87, 194, 0.2);
        transition: all 0.3s ease;
        background-color: var(--light-bg);
        color: var(--text-dark);
    }

    .form-control:focus {
        box-shadow: 0 0 0 4px rgba(126, 87, 194, 0.15);
        border-color: var(--primary-color);
        background-color: white;
    }

    /* Button styling */
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(126, 87, 194, 0.2);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(126, 87, 194, 0.3);
    }

    .btn-back {
        background-color: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-light);
        border-radius: 50px;
        padding: 0.5rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(126, 87, 194, 0.1);
    }

    .btn-back:hover {
        background-color: var(--light-bg);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(126, 87, 194, 0.15);
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm animate-fade-in">
    <div class="card-header">
        <h4 class="mb-0"><i class="bi bi-tags me-2"></i>Edit Kategori</h4>
        <a href="{{ route('kategori-barangs.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori-barangs.update', $kategori_barang->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="nama_kategori" class="form-label fw-bold">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ $kategori_barang->nama_kategori }}" required placeholder="Masukkan nama kategori">
                @error('nama_kategori')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-clockwise me-2"></i>Update
            </button>
        </form>
    </div>
</div>
@endsection