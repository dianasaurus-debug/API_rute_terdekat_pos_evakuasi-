<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = ['name'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sopBpbd()
    {
        return $this->hasMany(SopBpbd::class);
    }

    public function riwayatBencana()
    {
        return $this->hasMany(RiwayatBencana::class);
    }
}
