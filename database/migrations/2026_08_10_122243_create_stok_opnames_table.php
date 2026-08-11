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
        Schema::create('stok_opnames', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign key (menghubungkan ke table barang)
            $table->unsignedBigInteger('barang_id');
            $table->date('tanggal');
            $table->integer('stok_fisik');
            $table->integer('stok_sistem');
            $table->integer('selisih');
            $table->text('keterangan')->nullable();

            //relasi foreign key
            $table->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_opnames');
    }
};
