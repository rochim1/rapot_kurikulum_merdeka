<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAjaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';
    protected $guarded = ['id_tahun_ajaran'];
}
