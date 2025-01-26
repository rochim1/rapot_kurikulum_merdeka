<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    protected $table = 'tb_profil_sekolah';
    protected $primaryKey = 'id_profil_sekolah';
    protected $guarded = ['id_profil_sekolah'];
}
