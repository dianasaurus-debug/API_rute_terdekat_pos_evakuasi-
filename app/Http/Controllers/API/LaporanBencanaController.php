<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaporanBencanaResource;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $laporan_bencana = LaporanBencana::orderBy('tanggal')->with('user', 'bencana')->get();

        return response()->json([
            'message' => 'Successfully display laporan bencana data',
            'data' => LaporanBencanaResource::collection($laporan_bencana)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'tanggal' => 'required',
            'bencana_id' => 'required',
        ]);
        $laporan_bencana = new LaporanBencana([
            'user_id' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'bencana_id' => $request->bencana_id,
        ]);
        $laporan_bencana->save();
        return response()->json([
            'message' => 'Successfully created laporan bencana!',
            'data' => $laporan_bencana
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validasi($id)
    {
        $laporan_bencana = LaporanBencana::findOrFail($id);
        $laporan_bencana->update(['status' => 'disetujui']);
        $laporan_bencana->save();
        return response()->json([
            'message' => 'Successfully approve laporan bencana data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject($id)
    {
        $laporan_bencana = LaporanBencana::findOrFail($id);
        $laporan_bencana->update(['status' => 'ditolak']);
        $laporan_bencana->save();
        return response()->json([
            'message' => 'Successfully reject laporan bencana data'
        ]);
    }
}
