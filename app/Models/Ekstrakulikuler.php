<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekstrakulikuler extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tb_ekstrakulikuler';
    protected $primaryKey = 'id_ekstrakulikuler';
    protected $fillable = ['nama_ekstrakulikuler'];

    public function rapot()
    {
        return $this->belongsToMany(Rapot::class, 'tb_rapot_ekstrakulikuler', 'id_ekstrakulikuler', 'id_rapot')
                    ->withPivot('predikat_ekstrakulikuler', 'catatan_ekstrakulikuler');
    }
}
