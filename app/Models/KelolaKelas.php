<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelolaKelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_kelola_kelas';
    protected $primaryKey = 'id_kelola_kelas';
    protected $guarded = ['id_kelola_kelas'];


     public function Guru()
     {
         return $this->belongsTo(Guru::class, 'id_guru');
     }
 
     public function TahunAjaran()
     {
        //  return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
         return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
     }

     public function Rapot()
     {
         return $this->hasMany(Rapot::class, 'id_kelola_kelas', 'id_kelola_kelas');
     }
     
    // public function siswa()
    // {
    //     return $this->belongsToMany(Siswa::class, 'tb_ambil_kelas', 'id_kelola_kelas', 'id_siswa')
    //                 ->withTimestamps();
    // }


    protected $casts = [
        'daftar_id_siswa' => 'array', // Ubah menjadi array
    ];
    
    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->hasManyThrough(Siswa::class, KelolaKelas::class, 'id_kelola_kelas', 'id_siswa', 'id_kelola_kelas', 'id_siswa');
    }

    // Mendapatkan siswa berdasarkan daftar_id_siswa
    public function getSiswa()
    {
        return Siswa::whereIn('id_siswa', $this->daftar_id_siswa)->get();
    }
}
