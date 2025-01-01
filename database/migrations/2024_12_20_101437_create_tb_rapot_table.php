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
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->unsignedBigInteger('id_tahun_ajaran')->nullable();
            $table->unsignedBigInteger('id_siswa')->nullable();

            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('tanpa_keterangan')->nullable();

            $table->text('catatan_wali_kelas')->nullable();

            $table->tinyInteger('ket_naik_kelas')->nullable();
            $table->string('ttd_tempat_tanggal_rapot',50)->nullable();
            $table->string('nama_wali_kelas')->nullable();
            $table->string('nip_wali_kelas')->nullable();
            $table->string('nama_kepsek')->nullable();
            $table->string('nip_kepsek')->nullable();
            
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
