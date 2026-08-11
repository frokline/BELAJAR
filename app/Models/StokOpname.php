<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'tanggal',
        'stok_fisik',
        'stok_sistem',
        'selisih',
        'keterangan'
    ];

    //relasi stok opname ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
