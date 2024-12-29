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
        Schema::create('tb_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_kelas');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->enum('kelas_tingkatan', ['I','II','III','IV','V','VI']);
            $table->enum('kelas_abjad', ['A','B','C','D','E','F']);
            $table->enum('fase',['A','B','C']);
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
        Schema::dropIfExists('tb_kelas');
    }
};
