<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapotNilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapot_nilai';
    protected $primaryKey = 'id_rapot_nilai';
    protected $guarded = ['id_rapot_nilai'];

    // Relasi ke model Mapel
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    // Relasi ke model Mapel
    public function rapot()
    {
        return $this->belongsTo(Rapot::class, 'id_rapot', 'id_rapot');
    }
}
