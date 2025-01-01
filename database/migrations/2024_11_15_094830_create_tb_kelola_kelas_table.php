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
        Schema::create('tb_kelola_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_kelola_kelas');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->json('daftar_id_siswa');
            $table->foreign('id_guru')->references('id_guru')->on('tb_guru')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade');
            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tb_tahun_ajaran')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kelola_kelas');
    }
};
