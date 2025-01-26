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
}
