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

<<<<<<< HEAD
    public function Rapot()
    {
        return $this->hasMany(Rapot::class, 'id_siswa', 'id_siswa');
    }
=======
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'tb_ambil_kelas', 'id_siswa', 'id_kelas')
                    ->withTimestamps();
    }

>>>>>>> be28cd80851abf75b46053831481c5177801f097
}
