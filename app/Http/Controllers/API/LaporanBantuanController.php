<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaporanBantuanResource;
use App\Models\LaporanBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $laporan_bantuan = LaporanBantuan::orderBy('tanggal')->with('user', 'bantuan')->get();

        return response()->json([
            'message' => 'Successfully display laporan bantuan data',
            'data' => LaporanBantuanResource::collection($laporan_bantuan)
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
            'bantuan_id' => 'required',
        ]);
        $laporan_bantuan = new LaporanBantuan([
            'user_id' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'bantuan_id' => $request->bantuan_id,
        ]);
        $laporan_bantuan->save();
        return response()->json([
            'message' => 'Successfully created laporan bantuan!',
            'data' => $laporan_bantuan
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
        $laporan_bencana = LaporanBantuan::findOrFail($id);
        $laporan_bencana->bencana->update(['status' => 'disetujui']);
        $laporan_bencana->save();
        return response()->json([
            'message' => 'Successfully approve laporan bencana data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function laksanakan($id)
    {
        $laporan_bencana = LaporanBantuan::findOrFail($id);
        $laporan_bencana->bencana->update(['status' => 'dilaksanakan']);
        $laporan_bencana->save();
        return response()->json([
            'message' => 'Successfully execute laporan bencana data'
        ]);
    }
}
