<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Bpbd extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
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
