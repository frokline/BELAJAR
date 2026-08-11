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
        $tables = [
            'penjualans' => 'penjualans',
            'stok_opnames' => 'stok_opnames',
            'harga_barang_histories' => 'harga_barang_histories',
            'barang_masuks' => 'barang_masuks',
        ];

        foreach ($tables as $tableName) {
            if (!Schema::hasColumn($tableName, 'user_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['penjualans', 'stok_opnames', 'harga_barang_histories', 'barang_masuks'] as $tableName) {
            if (Schema::hasColumn($tableName, 'user_id')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $table->dropForeign([$tableName . '_user_id_foreign']);
                    $table->dropColumn('user_id');
                });
            }
        }
    }
};
