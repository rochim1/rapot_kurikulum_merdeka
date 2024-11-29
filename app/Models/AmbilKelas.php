<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbilKelas extends Model
{
    use HasFactory;

    protected $table='tb_ambil_kelas';
    protected $guarded=['id_ambil_kelas'];
    protected $primaryKey='id_ambil_kelas';
}
