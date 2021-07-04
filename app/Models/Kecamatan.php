<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    use HasFactory;

    public function desa()
    {
        return $this->hasMany(Desa::class);
    }

    public function posEvakuasi()
    {
        return $this->hasManyThrough(PosEvakuasi::class, Desa::class);
    }
}
