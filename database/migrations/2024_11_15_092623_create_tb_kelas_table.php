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
            $table->bigInteger('id_guru');
            $table->string('nama_kelas',50);
            $table->enum('tingkat',['1','2','3','4','5','6']);
            $table->string('tahuan_ajaran',10);
            $table->enum('fase',['A','B','C']);
            $table->foreign('id_guru')->references('id_guru')->on('tb_guru')->onDelete('cascade');
            $table->timestamps();
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