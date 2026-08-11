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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign key ke user
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->string('action');   //contoh cretae, update, delet, dan login 
            $table->string('model_type');
            $table->unsignedBigInteger('model_id')->nullable();

            //detail perubahan data (di simpan dalam format json)
            $table->json('old_values')->nullable();      // data sebelum di ubah 
            $table->json('new_values')->nullable();     //data sesudah di ubah

            $table->string('ip_address')->nullable();   //alamat ip user
            $table->string('user_agent')->nullable();   //info browser/perangkat


            //relasi user
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');     //jika user dihapus, log tetap ada untuk bukti sejarah


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
