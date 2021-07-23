<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PoskoEvakuasiResource extends JsonResource
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
            'nama_posko' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'kecamatan' => $this->desa != null ? $this->desa->kecamatan->nama : '-',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
