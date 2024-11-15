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
        Schema::create('tb_ekstrakulikuler', function (Blueprint $table) {
            $table->bigIncrements('id_ekstrakulikuler');
            $table->string('nama_ekstrakulikuler', 38);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ekstrakulikuler');
    }
};
