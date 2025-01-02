<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';
    protected $guarded = ['id_siswa'];

    public function Rapot()
    {
        return $this->hasMany(Rapot::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'tb_ambil_kelas', 'id_siswa', 'id_kelas')
                    ->withTimestamps();
    }

    public function tahunAjaran()
    {
        return $this->belongsToMany(TahunAjaran::class, 'tb_siswa_tahun_ajaran', 'id_siswa', 'id_tahun_ajaran');
    }

    public function ekstrakulikuler()
    {
        return $this->belongsToMany(Ekstrakulikuler::class, 'tb_rapot_ekstrakulikuler', 'id_ekstrakulikuler', 'id_ekstrakulikuler')
                    ->withPivot('predikat_ekstrakulikuler', 'catatan_ekstrakulikuler');
    }   

}
