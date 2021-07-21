<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanBencanaResource extends JsonResource
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
            'bencana' => $this->bencana->nama,
            'status' => $this->status,
            'nomor_hp' => $this->user->phone,
            'tanggal' => Carbon::createFromFormat('Y-m-d', $this->tanggal)->isoFormat('D MMMM Y'),
        ];
    }
}
