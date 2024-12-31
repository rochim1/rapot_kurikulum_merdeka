<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaTahunAjaran extends Model
{
    use HasFactory;

    protected $table='tb_siswa_tahun_ajaran';
    protected $guarded=['id_siswa_tahun_ajaran'];
    protected $primaryKey='id_siswa_tahun_ajaran';

    // wali kelas
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
