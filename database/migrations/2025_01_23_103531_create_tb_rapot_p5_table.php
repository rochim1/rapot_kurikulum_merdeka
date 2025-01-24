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
        Schema::create('tb_rapot_p5', function (Blueprint $table) {
            $table->bigIncrements('id_rapot_p5');
            $table->unsignedBigInteger('id_rapot')->unsigned()->nullable()->index();
            $table->unsignedBigInteger('id_kelompok_projek')->unsigned()->nullable()->index();
            $table->boolean('muai_bekermbang')->nullable();
            $table->boolean('sedang_berkembang')->nullable();
            $table->boolean('berkembang_sesuai_harapan')->nullable();
            $table->boolean('sangat_berkembang')->nullable();
            $table->text('catatan_proses')->nullable();

            $table->foreign('id_rapot')->references('id_rapot')->on('tb_rapot')->onDelete('cascade');
            $table->foreign('id_kelompok_projek')->references('id_kelompok_projek')->on('tb_kelompok_projek')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rapot_p5');
    }
};
