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
        Schema::create('tb_mata_pelajaran', function (Blueprint $table) {
            $table->bigIncrements('id_mata_pelajaran');
            $table->string('nama_mata_pelajaran',50);
            $table->enum('kelompok',['A','B','C']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mata_pelajaran');
    }
};
