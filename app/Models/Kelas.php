<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_kelas';
    protected $primaryKey = 'id_kelas';
    protected $guarded = ['id_kelas'];


     public function Guru()
     {
         return $this->belongsTo(Guru::class, 'id_guru');
     }
 
     public function TahunAjaran()
     {
         return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
     }

     public function Rapot()
     {
         return $this->hasMany(Rapot::class, 'id_kelas', 'id_kelas');
     }
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'tb_ambil_kelas', 'id_kelas', 'id_siswa')
                    ->withTimestamps();
    }

}
