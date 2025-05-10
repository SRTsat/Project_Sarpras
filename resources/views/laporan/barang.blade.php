@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Barang</h1>

    {{-- <a href="{{ route('laporan.barang.excel') }}" class="btn btn-success mb-3">Export ke Excel</a> --}}

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}" width="80">
                    @else
                    <span>Tidak ada foto</span>
                    @endif
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>{{ $barang->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection