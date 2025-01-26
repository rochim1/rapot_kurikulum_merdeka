<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokProjek extends Model
{
    use HasFactory;

    protected $table = 'tb_kelompok_projek';
    protected $primaryKey = 'id_kelompok_projek';
    protected $guarded = ['id_kelompok_projek'];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
