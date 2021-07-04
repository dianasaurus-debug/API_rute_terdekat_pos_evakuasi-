<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBantuan extends Model
{
    protected $table = 'laporan_bantuan';

    use HasFactory;

    public function validation() 
    {
        return $this->morphOne(Validation::class, 'validationable');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
