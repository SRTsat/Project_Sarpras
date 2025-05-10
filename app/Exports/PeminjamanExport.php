<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromArray;

class PeminjamanExport implements FromArray
{
    public function array(): array
    {
        return Peminjaman::with('barang')->get()->toArray();
    }
}
