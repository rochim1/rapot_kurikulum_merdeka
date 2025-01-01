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
}
