<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $table = 'bantuan';

    use HasFactory;

    public function laporanBantuan()
    {
        return $this->hasMany(LaporanBantuan::class);
    }
}
