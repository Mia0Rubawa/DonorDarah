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
        Schema::create('pivot_data_pengganti_donor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_individu_id')->nullable()->references('id')->on('akun_individu')->onDelete('cascade');
            $table->text('nama_pasien')->nullable();
            $table->foreignId('penyakit_id')->nullable()->references('id')->on('master_data_penyakit')->onDelete('cascade');
            $table->datetime('tanggal_rawat')->nullable();
            $table->datetime('tanggal_permintaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_data_pengganti_donor');
    }
};
