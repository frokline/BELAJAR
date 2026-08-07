<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


//ini adalah perintah sakti, di mana di extens model ini bertindak seperti robot(dia yang mengatur CRUD)
class Supplier extends Model
{
    //mengaktifkan kedua kekuatan di di atasa ke dalam model ini
    use HasFactory;
    use SoftDeletes; 

    //mendaftarkan data yang boleh kita isi nantinya
    protected $fillable = [
        'nama_supplier',
        'no_hp',
        'email',
        'alamat'
    ];
}
