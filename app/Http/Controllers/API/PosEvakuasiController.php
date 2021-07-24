<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoskoEvakuasiResource;
use App\Models\PosEvakuasi;
use App\Models\PoskoEvakuasi;
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
    public function nearPosko(Request $request){
        $latawal=(float) $request->latawal;
        $longawal=(float) $request->longawal;

        $dataposko=PosEvakuasi::with('desa.kecamatan')->get();
        foreach ($dataposko as $item){
            $theta = $longawal - (float) $item->longitude;
            $miles = (sin(deg2rad($latawal)) * sin(deg2rad((float) $item->latitude))) + (cos(deg2rad($latawal)) * cos(deg2rad((float) $item->latitude)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers = $miles * 1.609344;
            $data[]=[
                'nama_posko'=>$item->nama,
                'latitude'=>$item->latitude,
                'longitude'=>$item->longitude,
                'jarak'=>$kilometers
            ];
        }
        foreach ($data as $key=>$item2){
            $jarakdata[]=[$item2["jarak"]];
            $jarakmin=min($jarakdata);
        }
        foreach ($data as $item3){
            if($item3["jarak"]==$jarakmin[0]){
                $data2[]=[
                    'nama_posko'=>$item3["nama_posko"],
                    'latitude'=>$item3["latitude"],
                    'longitude'=>$item3["longitude"],
                    'jarak'=>$item3["jarak"]
                ];
            }
        }
        $params = [
            'success'=> true,
            'code' => 302,
            'description' => 'Found',
            'message' => 'Get Posko Evakuasi Success!',
            'jarakminimal' => $jarakmin[0],
            'palingdekat' => $data2,
        ];
        return response()->json($params);
    }

}
