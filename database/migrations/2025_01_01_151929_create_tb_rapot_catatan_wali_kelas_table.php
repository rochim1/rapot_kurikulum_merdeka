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
        Schema::create('tb_rapot_catatan_wali_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_rapot_catatan_wali_kelas');
            $table->unsignedBigInteger('id_rapot');
            $table->text('catatan_wali_kelas');
            $table->foreign('id_rapot')->references('id_rapot')->on('tb_rapot')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rapot_catatan_wali_kelas');
    }
};
