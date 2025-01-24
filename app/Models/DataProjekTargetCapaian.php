<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProjekTargetCapaian extends Model
{
    use HasFactory;

    protected $table = 'tb_data_projek_target_capaian';
    protected $primaryKey = 'id_data_projek_target_capaian';
    protected $guarded=['id_data_projek_target_capaian'];

    public function dataProjek()
    {
        return $this->belongsTo(DataProjek::class, 'id_data_projek');
    }

    public function targetCapaian()
    {
        return $this->belongsTo(targetCapaian::class, 'id_target_capaian');
    }
}
