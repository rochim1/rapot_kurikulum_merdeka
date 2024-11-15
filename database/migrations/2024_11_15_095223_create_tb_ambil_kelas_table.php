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
        Schema::create('tb_ambil_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_ambil_kelas');
            $table->bigInteger('id_kelas');
            $table->bigInteger('id_siswa');
            $table->foreign('id_kelas')->references('id_kelas')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ambil_kelas');
    }
};