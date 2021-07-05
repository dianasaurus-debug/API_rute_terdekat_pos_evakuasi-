<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    protected $fillable = [
        'bpbd_id',
        'target_id',
        'target_type'
    ];

    public function validationable() {
        return $this->morphTo();
    }
}
