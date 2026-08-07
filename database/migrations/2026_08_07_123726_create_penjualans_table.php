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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nomor_nota')->unique();
            $table->dateTime('tanggal')->index();

            //foreign key -> pelanggan
            $table->unsignedBigInteger('id_pelanggan')->nullable();

            //hitungan keuangan
            $table->integer('subtotal');
            $table->integer('diskon')->default(0);
            $table->integer('pajak')->default(0);
            $table->integer('total');
            $table->integer('bayar');
            $table->integer('kembalian');

            //status dan pembayaran
            $table->enum('metode_pembayaran', ['cash', 'qris', 'transfer', 'debit']);
            $table->enum('status', ['lunas', 'piutang', 'batal'])->default('lunas');
            
            $table->timestamps();

            //relasi foreign key
            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('pelanggans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
