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
        Schema::create('tb_tema', function (Blueprint $table) {
            $table->bigIncrements('id_tema');
            $table->unsignedBigInteger('id_tahun_ajaran')->nullable();
            $table->string('dimensi', 100)->nullable();
            $table->text('deskripsi_dimensi')->nullable();
            $table->string('nama_tema', 100)->nullable();
            $table->text('deskripsi_tema')->nullable();

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
        Schema::dropIfExists('tb_tema');
    }
};
