<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TujuanPembelajaran extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    protected $table = 'tb_tujuan_pembelajaran';
    protected $primaryKey = 'id_tujuan_pembelajaran';
    protected $guarded = ['id_tujuan_pembelajaran'];

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Relasi ke model Mapel
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }
}
