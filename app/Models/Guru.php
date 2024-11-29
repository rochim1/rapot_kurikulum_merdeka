<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='tb_guru';
    protected $primaryKey = 'id_guru';
    protected $guarded=['id_guru'];

    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

<<<<<<< HEAD
    public function Kelas()
    {
        return $this->hasMany(Kelas::class);
=======
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
>>>>>>> 73d461624707df7d478332920915bc11d2fe1388
    }
}
