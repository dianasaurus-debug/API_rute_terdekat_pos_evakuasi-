<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class RiwayatBencanaResource extends JsonResource
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
            'desa' => $this->desa != null ? $this->desa->nama : '-',
            'bencana' => $this->bencana != null ? $this->bencana->nama : '-',
            'tahun' => Carbon::createFromFormat('Y-m-d', $this->tanggal)->year,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
