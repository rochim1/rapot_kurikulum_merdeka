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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->bigIncrements('id_siswa');
            $table->string('nama', 100);
            $table->string('nis')->unique();
            $table->string('nisn')->unique()->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jk', 10);
            $table->string('agama', 50)->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('no_telp_ortu', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->text('foto')->nullable();
            $table->enum('status',['active','berhenti','mutasi','pensiun']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswa');
    }
};
