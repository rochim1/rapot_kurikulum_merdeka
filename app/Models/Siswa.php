<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';
    protected $guarded = ['id_siswa'];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'tb_ambil_kelas', 'id_siswa', 'id_kelas')
                    ->withTimestamps();
    }

}
