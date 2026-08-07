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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal_masuk');

            // foreign key (menghubungkan ke 2 tabel induk)
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_supplier');

            $table->integer('jumlah_masuk');
            $table->integer('harga_beli');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            
            $table->foreign('id_barang')
                ->references('id')
                ->on('barangs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('id_supplier')
                ->references('id')
                ->on('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
