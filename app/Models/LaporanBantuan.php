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
        'date',
        'description'
    ];

    public function validation() 
    {
        return $this->morphOne(Validation::class, 'validationable');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
