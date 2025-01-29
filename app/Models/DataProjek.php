<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProjek extends Model
{
    use HasFactory;

    protected $table = 'tb_data_projek';
    protected $primaryKey = 'id_data_projek';
    protected $guarded = ['id_data_projek'];
    
    public function DataProjekTargetCapaian()
    {
        return $this->hasMany(DataProjekTargetCapaian::class, 'id_data_projek');
    }
}
