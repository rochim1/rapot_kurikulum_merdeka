<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapotNilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapot_nilai';
    protected $primaryKey = 'id_rapot_nilai';
    protected $guarded = ['id_rapot_nilai'];
}
