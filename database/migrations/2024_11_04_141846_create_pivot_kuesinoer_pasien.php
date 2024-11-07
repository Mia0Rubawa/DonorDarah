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
        Schema::create('pivot_kuesinoer_pasien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_individu_id')->nullable()->references('id')->on('akun_individu')->onDelete('cascade');
            $table->foreignId('kuesioner_id')->nullable()->references('id')->on('kuesioner_pasien')->onDelete('cascade');
            $table->datetime('tanggal_isi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kuesinoer_pasien');
    }
};
