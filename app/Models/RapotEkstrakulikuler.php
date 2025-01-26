<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapotEkstrakulikuler extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapot_ekstrakulikuler';
    protected $primaryKey = 'id_rapot_ekstrakulikuler';
    protected $guarded = ['id_rapot_ekstrakulikuler'];

    public function Rapot()
    {
        return $this->hasMany(Rapot::class, 'id_siswa', 'id_siswa');
    }

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'id_ekstrakulikuler');
    }
}
