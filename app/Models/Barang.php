<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
   protected $fillable = ['kategori_id', 'nama_barang', 'jumlah', 'kondisi', 'foto'];
   protected $table = 'barang';

   public function kategori()
   {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
   }

   public function peminjaman()
   {
        return $this->hasMany(peminjaman::class, 'barang_id');
   }
}
