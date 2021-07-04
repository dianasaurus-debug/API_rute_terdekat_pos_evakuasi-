<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosEvakuasi extends Model
{
    protected $table = 'pos_evakuasi';

    use HasFactory;

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
