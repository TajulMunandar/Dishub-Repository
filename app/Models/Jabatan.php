<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function Staff()
    {
        return $this->hasMany(Staff::class, 'id_jabatan');
    }
}
