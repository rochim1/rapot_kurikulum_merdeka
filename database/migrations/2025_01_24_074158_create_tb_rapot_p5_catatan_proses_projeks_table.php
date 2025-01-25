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
        Schema::create('tb_rapot_p5_catatan_proses_projek', function (Blueprint $table) {
            $table->bigIncrements('id_rapot_p5_catatan_proses_projek');
            $table->unsignedBigInteger('id_rapot')->nullable();
            $table->unsignedBigInteger('id_kel_pro_data_pro')->nullable();
            $table->text('catatan_proses_projek')->nullable();

            $table->foreign('id_rapot')->references('id_rapot')->on('tb_rapot')->onDelete('cascade');
            $table->foreign('id_kel_pro_data_pro')->references('id_kelompok_projek_data_projek')->on('tb_kelompok_projek_data_projek')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rapot_p5_catatan_proses_projek');
    }
};
