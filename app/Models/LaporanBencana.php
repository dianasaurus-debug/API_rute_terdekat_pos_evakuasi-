<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBencana extends Model
{
    use HasFactory;

    protected $table = 'laporan_bencana';

    protected $fillable = [
        'user_id',
        'bencana_id',
        'tanggal',
        'deskripsi',
    ];

    protected $appends = [
        'status'
    ];

    public function validation() 
    {
        return $this->morphOne(Validation::class, 'target');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function getStatusAttribute()
    {
        return $this->validation ? 'DISETUJUI' : 'MENUNGGU';
    }
}
