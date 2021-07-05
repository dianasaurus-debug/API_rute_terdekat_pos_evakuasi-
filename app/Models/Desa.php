<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';

    protected $fillable = [
        'kecamatan_id',
        'name',
        'longitude',
        'latitude'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function posEvakuasi()
    {
        return $this->hasMany(PosEvakuasi::class);
    }

    public function riwayatBencana()
    {
        return $this->hasMany(RiwayatBencana::class);
    }
}
