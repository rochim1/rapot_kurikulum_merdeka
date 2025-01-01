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
}
