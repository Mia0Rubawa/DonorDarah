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
        Schema::create('akun_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id')->nullable()->references('id')->on('reg_provinces')->onDelete('cascade');
            $table->foreignId('kabupaten_id')->nullable()->references('id')->on('reg_regencies')->onDelete('cascade');
            $table->foreignId('kecamatan_id')->nullable()->references('id')->on('reg_districts')->onDelete('cascade');
            $table->foreignId('kelurahan_desa_id')->nullable()->references('id')->on('reg_villages')->onDelete('cascade');
            $table->foreignId('jk_id')->nullable()->references('id')->on('master_data_jenis_kelamin')->onDelete('cascade');
            $table->foreignId('rhesus_id')->nullable()->references('id')->on('master_data_rhesus')->onDelete('cascade');
            $table->text('nama_lengkap')->nullable();
            $table->text('username')->nullable();
            $table->text('email')->comment('Sebagai Login')->nullable();
            $table->text('password')->comment('Sebagai Login')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('tempat_lahir')->nullable();
            $table->string('no_identitas')->nullable();
            $table->string('no_telepon')->nullable();
            $table->enum('jenis_identitas', ['ktp', 'sim', 'lain-lain', null])->default('lain-lain')->nullable();
            $table->text('tempat_tinggal_lahir')->nullable();
            $table->enum('status_menikah', ['ya', 'tidak'])->default('tidak');
            $table->enum('macam_donor', ['sukarela', 'ganti', null])->default(null)->nullable();
            $table->enum('donor_perlu', ['ya', 'tidak'])->default('tidak');
            $table->enum('donor_puasa', ['ya', 'tidak'])->default('tidak');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_individu');
    }
};
