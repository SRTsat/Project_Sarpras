@extends('layouts.app')
@section('title', 'Edit Barang')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(126, 87, 194, 0.2);
        transition: all 0.3s ease;
        background-color: var(--light-bg);
        color: var(--text-dark);
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 4px rgba(126, 87, 194, 0.15);
        border-color: var(--primary-color);
        background-color: white;
    }

    .form-control[type="file"] {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    
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

    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .alert-danger {
        background-color: rgba(244, 67, 54, 0.1);
        color: #d32f2f;
        border-left: 4px solid #f44336;
    }
    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
    .alert-danger li {
        margin-bottom: 5px;
    }

    .img-preview {
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        border: 1px solid var(--primary-light);
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm animate-fade-in">
    <div class="card-header">
        <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i>Edit Barang</h4>
        <a href="{{ route('barangs.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger mb-4" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-select">
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label fw-bold">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required placeholder="Masukkan nama barang">
                @error('nama_barang')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $barang->jumlah }}" required placeholder="Masukkan jumlah barang">
                @error('jumlah')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kondisi" class="form-label fw-bold">Kondisi</label>
                <input type="text" name="kondisi" id="kondisi" class="form-control" value="{{ $barang->kondisi }}" required placeholder="Masukkan kondisi barang (misal: Baik, Rusak)">
                @error('kondisi')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            @if ($barang->foto)
            <div class="mb-3">
                <label class="form-label fw-bold d-block">Foto Barang Saat Ini</label>
                <img src="{{ asset('storage/' . $barang->foto) }}" width="200" class="img-preview">
            </div>
            @endif
            <div class="mb-3">
                <label for="foto" class="form-label fw-bold">Ganti Foto Barang</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                @error('foto')
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