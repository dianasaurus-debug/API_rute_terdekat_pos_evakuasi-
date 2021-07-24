<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaporanBencanaResource;
use App\Models\LaporanBencana;
use App\Models\Validation;
use App\Models\Bencana;
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
    public function indexBencana()
    {
        $bencana = Bencana::all();

        return response()->json([
            'message' => 'Successfully display laporan bantuan data',
            'data' => $bencana,
            'success' => true
        ]);
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
            'user_id' => auth()->guard('user-api')->user()->id,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'bencana_id' => $request->bencana_id,
        ]);
        $laporan_bencana->save();
        return response()->json([
            'message' => 'Successfully created laporan bencana!',
            'data' => $laporan_bencana,
            'success'=> true
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
        $laporan_bencana = LaporanBencana::find($id);
        $data_validasi = [
            'target_id' => $laporan_bencana->id,
            'target_type' => 'laporan_bencana',
            'bpbd_id' => auth()->guard('bpbd-api')->user()->id
        ];
        $laporan_bencana->validation()->create($data_validasi);
        return response()->json([
            'message' => 'Sukses approve laporan bencana data',
            'success' => true,
            'data' => $laporan_bencana
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
        $laporan_bencana = LaporanBencana::find($id);
        $validasi = Validation::where('target_id', $laporan_bencana->id)->where('target_type', 'App\Models\LaporanBencana');
        $validasi->delete();
        $laporan_bencana->delete();
        return response()->json([
            'message' => 'Sukses menolak laporan bencana data',
            'success' => true,
            'data' => $laporan_bencana
        ]);
    }
}
