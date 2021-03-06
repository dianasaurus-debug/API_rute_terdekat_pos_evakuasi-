<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosEvakuasi extends Model
{
    use HasFactory;

    protected $table = 'pos_evakuasi';

    protected $fillable = [
        'desa_id',
        'nama',
        'alamat',
        'latitude',
        'longitude',
        'deskripsi'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
