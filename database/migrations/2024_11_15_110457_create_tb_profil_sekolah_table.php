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
        Schema::create('tb_profil_sekolah', function (Blueprint $table) {
            $table->bigIncrements('id_profil_sekolah');
            $table->string('nama_sekolah');
            $table->string('akreditas');
            $table->string('npsn');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('telepon');
            $table->string('email');
            $table->string('nama_kepsek');
            $table->string('nip_kepsek');
            $table->string('pangkat_golongan_kepsek');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_profil_sekolah');
    }
};
