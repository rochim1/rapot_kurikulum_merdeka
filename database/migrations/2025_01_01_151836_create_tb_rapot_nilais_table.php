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
        Schema::create('tb_rapot_nilai', function (Blueprint $table) {
            $table->bigIncrements('id_rapot_nilai');
            $table->unsignedBigInteger('id_rapot');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->float('nilai_akhir');
            $table->longText('capaian_kompetensi_dicapat');
            $table->longText('capaian_kompetensi_tidak_dicapat');
            $table->foreign('id_rapot')->references('id_rapot')->on('tb_rapot')->onDelete('cascade');
            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('tb_mata_pelajaran')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rapot_nilai');
    }
};
