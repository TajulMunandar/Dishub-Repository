<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function BeritaAcara()
    {
        return $this->hasMany(BeritaAcara::class, 'id_staff');
    }
}
