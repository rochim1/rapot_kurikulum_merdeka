<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_rapor';
    protected $primaryKey = 'id_rapor';
    protected $guarded = ['id_rapor'];
}
