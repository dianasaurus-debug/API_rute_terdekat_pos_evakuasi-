<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan';

    protected $fillable = ['type', 'status'];

    public function laporanBantuan()
    {
        return $this->hasMany(LaporanBantuan::class, 'bantuan_id', 'id');
    }
}
