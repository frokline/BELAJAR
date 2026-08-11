<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaBarangHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'harga_beli_lama',
        'harga_beli_baru',
        'harga_jual_lama',
        'harga_jual_baru'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
