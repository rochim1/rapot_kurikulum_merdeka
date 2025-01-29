<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapotP5CapaianProjek extends Model
{
    use HasFactory;

    protected $table = 'tb_rapot_p5_capaian_projek';
    protected $primaryKey = 'id_rapot_p5_capaian_projek';
    protected $guarded = ['id_rapot_p5_capaian_projek'];

    public function rapot()
    {
        return $this->belongsTo(Rapot::class, 'id_rapot', 'id_rapot');
    }

    public function KelompokProjek()
    {
        return $this->belongsTo(KelompokProjek::class, 'id_kelompok_projek', 'id_kelompok_projek');
    }

    // public function KelompokProjekDataProjek()
    // {
    //     return $this->belongsTo(KelompokProjekDataProjek::class, 'id_kel_pro_data_pro', 'id_kelompok_projek_data_projek');
    // }
    public function kelompokProjekDataProjek()
{
    return $this->hasOne(KelompokProjekDataProjek::class);
}


}
