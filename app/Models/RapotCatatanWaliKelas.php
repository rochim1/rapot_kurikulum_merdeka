<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapotCatatanWaliKelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapot_catatan_wali_kelas';
    protected $primaryKey = 'id_rapot_catatan_wali_kelas';
    protected $guarded = ['id_rapot_catatan_wali_kelas'];
}
