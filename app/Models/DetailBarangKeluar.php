<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'detail_barang_keluars';

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'harga_jual',
        'jumlah_keluar',
        'subtotal',
    ];

    // Relasi ke model Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
