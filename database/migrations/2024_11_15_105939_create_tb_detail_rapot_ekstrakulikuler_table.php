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
        Schema::create('tb_detail_rapot_ekstrakulikuler', function (Blueprint $table) {
            $table->bigIncrements('id_detail_ekstrakulikuler');
            $table->unsignedBigInteger('id_ekstrakulikuler');
            $table->string('predikat',15);
            $table->longText('keterangan');
            $table->foreign('id_ekstrakulikuler')->references('id_ekstrakulikuler')->on('tb_ekstrakulikuler')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_rapot_ekstrakulikuler');
    }
};
