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
        Schema::create('tb_ambil_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_ambil_kelas');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_siswa');
            $table->enum('is_active',[1,2])->default(1);
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('tb_siswa')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ambil_kelas');
    }
};
