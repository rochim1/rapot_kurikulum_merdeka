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
        Schema::create('tb_kelompok_projek_data_projek', function (Blueprint $table) {
            $table->bigIncrements('id_kelompok_projek_data_projek');
            $table->unsignedBigInteger('id_kelompok_projek');
            $table->unsignedBigInteger('id_data_projek')->nullable();

            $table->foreign('id_kelompok_projek')->references('id_kelompok_projek')->on('tb_kelompok_projek')->onDelete('cascade');
            $table->foreign('id_data_projek')->references('id_data_projek')->on('tb_data_projek')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kelompok_projek_data_projek');
    }
};
