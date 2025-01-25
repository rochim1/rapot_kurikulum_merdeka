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
        Schema::create('tb_rapot_p5_capaianprojek', function (Blueprint $table) {
            $table->bigIncrements('id_rapot_p5_capaianprojek');
            // $table->unsignedBigInteger('id_rapot')->nullable();
            // $table->unsignedBigInteger('id_mata_pelajaran')->nullable();
            // $table->integer('nilai_akhir')->nullable();
            // $table->json('tujuan_pembelajaran_tercapai')->nullable();
            // $table->json('tujuan_pembelajaran_tidak_tercapai')->nullable();
            // $table->foreign('id_rapot')->references('id_rapot')->on('tb_rapot')->onDelete('cascade');
            // $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('tb_mata_pelajaran')->onDelete('cascade');
            // $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rapot_p5_capaian_projek');
    }
};
