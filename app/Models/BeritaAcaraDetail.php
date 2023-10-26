<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraDetail extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function BeritaAcara()
    {
        return $this->belongsTo(BeritaAcara::class, 'id_berita');
    }
}
