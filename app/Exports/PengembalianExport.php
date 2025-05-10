<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromArray;

class PengembalianExport implements FromArray
{
    public function array(): array
    {
        return Pengembalian::with('barang')->get()->toArray();
    }
}
