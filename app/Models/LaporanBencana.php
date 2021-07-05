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
        'date',
        'description',
        'status'
    ];

    public function validation() 
    {
        return $this->morphOne(Validation::class, 'validationable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
