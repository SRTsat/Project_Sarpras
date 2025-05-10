@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Permintaan Peminjaman</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->nama_peminjam }}</td>
                    <td>{{ $peminjaman->barang->nama_barang }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->jumlah_pinjam }}</td>
                    <td>
                        <span class="badge bg-{{ $peminjaman->status == 'disetujui' ? 'success' : ($peminjaman->status == 'ditolak' ? 'danger' : 'warning') }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($peminjaman->status == 'menunggu')
                            <form action="{{ route('peminjamans.approve', $peminjaman->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-success">Setujui</button>
                            </form>

                            <form action="{{ route('peminjamans.reject', $peminjaman->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-danger">Tolak</button>
                            </form>
                        @else
                            <form action="{{ route('peminjamans.destroy', $peminjaman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada permintaan peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
