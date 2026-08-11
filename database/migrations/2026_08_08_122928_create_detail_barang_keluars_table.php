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
        Schema::create('detail_barang_keluars', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign key (menghubungkan ke 2 tabel induk)
            $table->unsignedBigInteger('penjualan_id');
            $table->unsignedBigInteger('barang_id');

            //data history transaksi
            $table->integer('harga_jual');
            $table->integer('jumlah_keluar');
            $table->integer('subtotal');
            
            $table->timestamps();
            
            //relasi foreign key
            $table->foreign('penjualan_id')
                ->references('id')
                ->on('penjualans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barang_keluars');
    }
};
