<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = ['name'];

    public function sopBpbd()
    {
        return $this->hasOne(SopBpbd::class);
    }

    public function riwayatBencana()
    {
        return $this->hasMany(RiwayatBencana::class);
    }
}
