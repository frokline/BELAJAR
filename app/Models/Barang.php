<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'kategori_barang_id', // ✅ Daftarkan kolom baru di sini
        'id_supplier', 
        'nama_barang',
        'harga_jual',
        'stok'
    ];

    // barang mempunyai sebuah fungsi bernama kategori barang
    public function kategoriBarang()
    {
        //memberikan pentunjuk bahwa barang ini memiliki relasi belongsTo dengan model KategoriBarang, dan juga memberikan petunjuk gunakan kolom kategori_barang_id untuk mencari data pada model kategori barang
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
}