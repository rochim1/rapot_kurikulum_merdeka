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
        Schema::create('tb_tahun_ajaran', function (Blueprint $table) {
            $table->bigIncrements('id_tahun_ajaran');
            $table->integer('tahun_ajaran_awal');
            $table->integer('tahun_ajaran_akhir');
            $table->enum('semester', ['Ganjil','Genap']);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tahun_ajaran');
    }
};
