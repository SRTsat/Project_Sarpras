@extends('layouts.app')
@section('title', 'Data Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Data Kategori</h3>
        <a href="{{ route('kategori-barangs.create') }}" class="btn btn-success">+ Tambah Kategori</a>
    </div>

    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark">
            <tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($kategori as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori-barangs.edit', $kategori->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kategori-barangs.destroy', $kategori->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
