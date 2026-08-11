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
        Schema::create('harga_barang_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign key  (menghubungkan ke table barang)
            $table->unsignedBigInteger('barang_id');

            $table->integer('harga_beli_lama');
            $table->integer('harga_beli_baru');
            $table->integer('harga_jual_lama');
            $table->integer('harga_jual_baru');
            $table->timestamps();

            //relasi foreign key
            $table->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_barang_histories');
    }
};
