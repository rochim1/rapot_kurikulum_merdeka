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
        Schema::create('tb_guru', function (Blueprint $table) {
            $table->bigIncrements('id_guru');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->integer('mata_pelajaran_id')->unsigned()->nullable();
            // $table->string('nama', 100);
            $table->string('nip', 50)->nullable();
            $table->string('nrg', 50)->nullable();
            $table->string('jk', 10);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('golongan', 50)->nullable();
            $table->date('tmt_awal')->nullable();
            $table->string('pendidikan_terakhir', 50)->nullable();
            $table->string('status')->default('active')->nullable();
            $table->boolean('is_wali_kelas')->default(true);
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_guru');
    }
};
