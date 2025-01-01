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
        Schema::create('tb_rapot', function (Blueprint $table) {
            $table->bigIncrements('id_rapot');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('id_siswa');
            $table->tinyInteger('ket_naik_kelas');
            $table->string('ttd_tempat_tanggal_rapot',50);
            $table->string('nama_wali_kelas');
            $table->bigInteger('nip_wali_kelas');
            $table->string('nama_kepsek');
            $table->bigInteger('nip_kepsek');
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade');
            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tb_tahun_ajaran')->onDelete('cascade');
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
        Schema::dropIfExists('tb_rapot');
    }
};
