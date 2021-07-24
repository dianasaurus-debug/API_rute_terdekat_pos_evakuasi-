<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanBantuanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pelapor' => $this->user->name,
            'deskripsi' => $this->deskripsi,
            'bantuan' => $this->bantuan->type,
            'status' => $this->status,
            'nomor_hp' => $this->user->phone,
            'tanggal' => Carbon::parse($this->tanggal)->isoFormat('D MMMM Y'),
        ];
    }
}
