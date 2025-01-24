<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokProjekDataProjek extends Model
{
    use HasFactory;

    protected $table = 'tb_kelompok_projek_data_projek';
    protected $primaryKey = 'id_kelompok_projek_data_projek';
    protected $guarded = ['id_kelompok_projek_data_projek'];

    public function kelompokProjek()
    {
        return $this->belongsTo(kelompokProjek::class, 'id_kelompok_projek');
    }

    public function dataProjek()
    {
        return $this->belongsTo(DataProjek::class, 'id_data_projek');
    }
}
