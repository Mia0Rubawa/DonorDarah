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
        Schema::create('pivot_penyakit_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->nullable()->references('id')->on('master_data_penyakit')->onDelete('cascade');
            $table->foreignId('akun_individu_id')->nullable()->references('id')->on('akun_individu')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_penyakit_individu');
    }
};
