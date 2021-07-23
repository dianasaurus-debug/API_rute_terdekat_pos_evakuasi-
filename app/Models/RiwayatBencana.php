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
        'tanggal',
        'latitude',
        'longitude'
    ];

    public $timestamps = false;

    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class,'desa_id', 'id');
    }
}
