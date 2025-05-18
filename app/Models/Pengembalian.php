<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = ['peminjaman_id', 'tanggal_kembali', 'jumlah_kembali', 'kondisi_barang','nama_pengembali','foto_barang'];
    protected $table = 'pengembalians';

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}
