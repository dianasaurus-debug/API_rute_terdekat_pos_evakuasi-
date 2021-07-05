<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatBencana extends Model
{
    use HasFactory;

    protected $table = 'riwayat_bencana';

    protected $fillable = [
        'bencana_id',
        'desa_id',
        'date',
        'latitude',
        'longitude'
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
