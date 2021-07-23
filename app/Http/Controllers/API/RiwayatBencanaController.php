<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RiwayatBencanaResource;
use App\Models\RiwayatBencana;
use Illuminate\Http\Request;

class RiwayatBencanaController extends Controller
{
    public function index()
    {
        $riwayat_bencana = RiwayatBencana::orderBy('tanggal')->with('bencana', 'desa')->get();

        return response()->json([
            'message' => 'Successfully display riwayat bencana data',
            'data' => RiwayatBencanaResource::collection($riwayat_bencana)
        ]);
    }
}
