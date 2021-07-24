<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaporanBantuanResource;
use App\Models\LaporanBantuan;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bantuan;

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
            'success' => true,
            'message' => 'Successfully display laporan bantuan data',
            'data' => LaporanBantuanResource::collection($laporan_bantuan)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBantuan()
    {
        $bantuan = Bantuan::all();

        return response()->json([
            'message' => 'Successfully display laporan bantuan data',
            'data' => $bantuan,
            'success' => true,

        ]);
    }
    public function makeBantuan(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
        ]);
        $bantuan = new Bantuan([
            'type' => $request->type,
        ]);
        $bantuan->save();
        return response()->json([
            'message' => 'Successfully created laporan bantuan!',
            'success' => true,
            'data' => $bantuan
        ], 201);
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
            'bencana_id' => 'required'
        ]);
        $laporan_bantuan = new LaporanBantuan([
            'user_id' => auth()->guard('user-api')->user()->id,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'bantuan_id' => $request->bantuan_id,
            'bencana_id' => $request->bencana_id,
        ]);
        $laporan_bantuan->save();
        return response()->json([
            'message' => 'Successfully created laporan bantuan!',
            'success' => true,
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
        $laporan_bantuan = LaporanBantuan::find($id);
        $data_validasi = [
            'target_id' => $laporan_bantuan->id,
            'target_type' => 'laporan_bantuan',
            'bpbd_id' => auth()->guard('bpbd-api')->user()->id
        ];
        $laporan_bantuan->validation()->create($data_validasi);
        return response()->json([
            'message' => 'Sukses approve laporan bantuan data',
            'success' => true,
            'data' => $laporan_bantuan
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
        $laporan_bantuan = LaporanBantuan::find($id);
        $validasi = Validation::where('target_id', $laporan_bantuan->id)->where('target_type', 'App\Models\LaporanBantuan');
        $validasi->delete();
        $laporan_bantuan->delete();
        return response()->json([
            'message' => 'Sukses menolak laporan bantuan data',
            'success' => true,
            'data' => $laporan_bantuan
        ]);
    }
}
