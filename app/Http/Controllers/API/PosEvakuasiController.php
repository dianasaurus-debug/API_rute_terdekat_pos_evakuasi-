<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoskoEvakuasiResource;
use App\Models\PosEvakuasi;
use Illuminate\Http\Request;

class PosEvakuasiController extends Controller
{
    public function index()
    {
        $pos_evakuasi = PosEvakuasi::orderBy('nama')->with('desa.kecamatan')->get();

        return response()->json([
            'message' => 'Successfully display posko evakuasi data',
            'data' => PoskoEvakuasiResource::collection($pos_evakuasi)
        ]);
    }
}
