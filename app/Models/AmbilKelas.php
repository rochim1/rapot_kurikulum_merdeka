<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbilKelas extends Model
{
    use HasFactory;

    protected $table='tb_ambil_kelas';
    protected $guarded=['id_ambil_kelas'];
    protected $primaryKey='id_ambil_kelas';

    // Wali Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }   
}
