<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi: 1 User/Kasir bisa memiliki banyak transaksi penjualan
     */
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'user_id', 'id');
    }

    /**
     * Relasi: 1 User/Petugas bisa memiliki banyak catatan stok opname
     */
    public function stokOpnames()
    {
        return $this->hasMany(StokOpname::class, 'user_id', 'id');
    }

    /**
     * Relasi: 1 User/Admin bisa memiliki banyak catatan riwayat perubahan harga
     */
    public function hargaBarangHistories()
    {
        return $this->hasMany(HargaBarangHistory::class, 'user_id', 'id');
    }
}