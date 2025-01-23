<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetCapaian extends Model
{
    use HasFactory;

    protected $table = 'tb_target_capaian';
    protected $primaryKey = 'id_target_capaian';
    protected $guarded = ['id_target_capaian'];
}
