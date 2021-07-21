<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBantuan extends Model
{
    use HasFactory;

    protected $table = 'laporan_bantuan';

    protected $fillable = [
        'user_id',
        'bencana_id',
        'bantuan_id',
        'tanggal',
        'deskripsi'
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

    public function bantuan()
    {
        return $this->belongsTo(Bantuan::class);
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
