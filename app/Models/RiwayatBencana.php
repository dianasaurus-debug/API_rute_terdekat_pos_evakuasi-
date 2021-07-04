<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatBencana extends Model
{
    protected $table = 'riwayat_bencana';

    use HasFactory;

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
