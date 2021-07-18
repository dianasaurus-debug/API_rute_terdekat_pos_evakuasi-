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
        'bantuan_id',
        'tanggal',
        'description'
    ];

    public function validation()
    {
        return $this->morphOne(Validation::class, 'validationable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bantuan()
    {
        return $this->belongsTo(Bantuan::class, 'bantuan_id', 'id');
    }
}
