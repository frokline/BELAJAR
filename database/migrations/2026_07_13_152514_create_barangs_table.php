<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');

            //membuat kolom kategori_barang_id sebagai foreign key yang mengacu pada kolom id di tabel kategori_barangs
            $table->foreignId('kategori_barang_id')
                //menentukan bahwa kolom kategori_barang_id mengacu pada kolom id di tabel kategori_barangs
                  ->constrained('kategori_barangs')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
                
            $table->unsignedBigInteger('id_supplier');
            $table->string('nama_barang')->index();
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
