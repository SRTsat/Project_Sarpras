<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['barang_id', 'user_id', 'tanggal_pinjam', 'jumlah_pinjam', 'status', 'nama_peminjam'];
    protected $table = 'peminjamans';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
