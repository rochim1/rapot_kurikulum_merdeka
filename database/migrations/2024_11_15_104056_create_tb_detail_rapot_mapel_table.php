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
        Schema::create('tb_detail_rapot_mapel', function (Blueprint $table) {
            $table->bigIncrements('id_detail_rapot_mapel');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->unsignedBigInteger('id_rapot');
            $table->float('nilai_akhir');
            $table->longText('capaian_kompetensi_dicapat');
            $table->longText('capaian_kompetensi_tidak_dicapat');
            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('tb_mata_pelajaran')->onDelete('cascade');
            $table->foreign('id_rapot')->references('id_rapot')->on('tb_rapot')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_rapot_mapel');
    }
};
