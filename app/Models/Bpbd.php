<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpbd extends Model
{
    use HasFactory;
    
    protected $table = 'bpbd';

    protected $fillable = [
        'nip',
        'username',
        'email',
        'password'
    ];

    public function validations() 
    {
        return $this->hasMany(Validation::class, 'bpbd_id', 'id');
    }
}
