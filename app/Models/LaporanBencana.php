<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBencana extends Model
{
    protected $table = 'laporan_bencana';

    use HasFactory;

    public function validation() {
        return $this->morphOne(Validation::class, 'validationable');
    }
}
