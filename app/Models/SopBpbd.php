<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopBpbd extends Model
{
    use HasFactory;

    protected $table = 'sop_bpbd';

    protected $fillable = [
        'bencana_id',
        'name',
        'tindakan'
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
