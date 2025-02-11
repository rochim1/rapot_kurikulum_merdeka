<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapot extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapot';
    protected $primaryKey = 'id_rapot';
    protected $guarded = ['id_rapot'];

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function ekstrakulikuler()
    {
        return $this->belongsToMany(Ekstrakulikuler::class, 'tb_rapot_ekstrakulikuler', 'id_rapot', 'id_ekstrakulikuler')
                    ->withPivot('predikat_ekstrakulikuler', 'catatan_ekstrakulikuler');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }

    public function rapotNilai()
    {
        return $this->hasMany(RapotNilai::class, 'id_rapot', 'id_rapot');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function rapotEkstrakulikuler()
    {
        return $this->hasMany(RapotEkstrakulikuler::class, 'id_rapot', 'id_rapot');
    }

    public function RapotP5CapaianProjek()
    {
        return $this->hasMany(RapotP5CapaianProjek::class, 'id_rapot', 'id_rapot');
    }

    public function RapotP5CatatanProsesProjek()
    {
        return $this->hasMany(RapotP5CatatanProsesProjek::class, 'id_rapot', 'id_rapot');
    }
}
