<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function Staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff');
    }

    public function BeritaAcaraDetail()
    {
        return $this->hasMany(BeritaAcaraDetail::class, 'id_berita');
    }

}
