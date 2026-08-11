<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_nota',
        'tanggal',
        'id_pelanggan',
        'subtotal',
        'diskon',
        'pajak',
        'total',
        'bayar',
        'kembalian',
        'metode_pembayaran',
        'status'
    ];

    //relasi penjualan ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    //relasi penjualan ke detail barang keluar
    public function detailBarangKeluars()
    {
        return $this->hasMany(DetailBarangKeluar::class, 'penjualan_id');
    
    }
}
