<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_mata_pelajaran';
    protected $primaryKey = 'id_mata_pelajaran';
    protected $guarded = ['id_mata_pelajaran'];

    public function gurus()
    {
        return $this->hasMany(Guru::class, 'mata_pelajaran_id');
    }
}
