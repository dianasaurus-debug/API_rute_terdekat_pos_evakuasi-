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

    protected $appends = [
        'is_first'
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function getIsFirstAttribute()
    {
        $sop = self::where('bencana_id', $this->bencana_id)
            ->where('nama', $this->nama)
            ->first();
        return $sop->id == $this->id;
    }
}
