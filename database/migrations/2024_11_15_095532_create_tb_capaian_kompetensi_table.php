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
        Schema::create('tb_capaian_kompetensi', function (Blueprint $table) {
            $table->bigIncrements('id_capaian_kompetensi');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->unsignedBigInteger('id_kelas');
            $table->text('target_capaian');
            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('tb_mata_pelajaran')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_capaian_kompetensi');
    }
};
