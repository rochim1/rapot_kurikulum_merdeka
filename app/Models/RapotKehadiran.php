<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapotKehadiran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapot_kehadiran';
    protected $primaryKey = 'id_rapot_kehadiran';
    protected $guarded = ['id_rapot_kehadiran'];
}
