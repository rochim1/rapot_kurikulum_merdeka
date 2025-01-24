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
        Schema::create('tb_data_projek_target_capaian', function (Blueprint $table) {
            $table->bigIncrements('id_data_projek_target_capaian');
            $table->unsignedBigInteger('id_data_projek')->nullable();
            $table->unsignedBigInteger('id_target_capaian')->nullable();

            $table->foreign('id_data_projek')->references('id_data_projek')->on('tb_data_projek')->onDelete('cascade');
            $table->foreign('id_target_capaian')->references('id_target_capaian')->on('tb_target_capaian')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_projek_target_capaian');
    }
};
