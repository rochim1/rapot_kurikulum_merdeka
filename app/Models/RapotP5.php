<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapotP5 extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_tb_rapot_p5';
    protected $primaryKey = 'id_rapot_p5';
    protected $guarded = ['id_rapot_p5'];
}
