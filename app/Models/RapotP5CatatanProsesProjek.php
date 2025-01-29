<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapotP5CatatanProsesProjek extends Model
{
    use HasFactory;

    protected $table = 'tb_rapot_p5_catatan_proses_projek';
    protected $primaryKey = 'id_rapot_p5_catatan_proses_projek';
    protected $guarded = ['id_rapot_p5_catatan_proses_projek'];

    public function rapot()
    {
        return $this->belongsTo(Rapot::class, 'id_rapot', 'id_rapot');
    }
}
