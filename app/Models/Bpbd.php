<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpbd extends Model
{
    protected $table = 'bpbd';

    use HasFactory;

    public function validations() {
        return $this->hasMany(Validation::class, 'bpbd_id', 'id');
    }
}
