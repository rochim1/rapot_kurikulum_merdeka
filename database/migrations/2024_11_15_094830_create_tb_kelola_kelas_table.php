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
        Schema::create('tb_kelola_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_kelola_kelas');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->string('nama_kelola_kelas',50);
            $table->enum('tingkat',['1','2','3','4','5','6']);
            $table->enum('fase',['A','B','C']);
            $table->enum('is_active',[1,2])->default(1);
            $table->foreign('id_guru')->references('id_guru')->on('tb_guru')->onDelete('cascade');
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
        Schema::dropIfExists('tb_kelola_kelas');
    }
};
