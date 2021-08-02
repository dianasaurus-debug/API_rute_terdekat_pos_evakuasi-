<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\RiwayatBencana;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Bencana  $bencana
     * @return \Illuminate\Http\Response
     */
    public function index(Bencana $bencana)
    {
        $riwayat = $bencana->riwayatBencana()->orderBy('tanggal', 'desc')->paginate(10);

        return view('riwayat.index', compact('riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Bencana  $bencana
     * @return \Illuminate\Http\Response
     */
    public function create(Bencana $bencana)
    {
        $kecamatan = Kecamatan::all();

        return view('riwayat.create', compact('bencana', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bencana  $bencana
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Bencana $bencana)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'desa_id' => 'required|exists:desa,id',
            'latitude' => 'nullable|string|max:100',
            'longitude' => 'nullable|string|max:100',
        ]);

        $request->merge([
            'tanggal' => Carbon::parse($request->tanggal)
        ]);
        $desa = Desa::where('id', $request->desa_id)->first();
        $bencana->riwayatBencana()->create($request->all());
        $url = 'https://fcm.googleapis.com/fcm/send';
        $topic = '/topics/bencana';

        $FcmKey = 'AAAAigTg9eY:APA91bF5k6_qIsNBmLxzLz8z91a7f0kQ7FV3CWHC_lwLsIMe8VF_5iW5FlZiAfzR4oABxIKpUw1NKQs-zqRCrO23Stzzus-NuN0xIdWlCymcXpghN466VpuQl7D47xOMyPzbTjK6qump';

        $data = [
            "to" => $topic,
            "notification" => [
                "title" => 'Awas! Ada ' .$bencana->nama,
                "body" => 'Terjadi '.$bencana->nama.' di desa '.$desa->nama.' pada hari ini',
            ],
            "data" => [
                "msgId" => "msg_12342"
            ]
        ];

        $RESPONSE = json_encode($data);

        $headers = [
            'Authorization:key=' . $FcmKey,
            'Content-Type: application/json',
        ];

        // CURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $RESPONSE);

        $output = curl_exec($ch);
        if ($output === FALSE) {
            die('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);
        return redirect()->route('riwayat.index', $bencana);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bencana  $bencana
     * @param  \App\Models\RiwayatBencana  $riwayatBencana
     * @return \Illuminate\Http\Response
     */
    public function edit(Bencana $bencana, RiwayatBencana $riwayatbencana)
    {
        $riwayat = $riwayatbencana;
        $kecamatan = Kecamatan::all();

        return view('riwayat.edit', compact('bencana', 'riwayat', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bencana  $bencana
     * @param  \App\Models\RiwayatBencana  $riwayatbencana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bencana $bencana, RiwayatBencana $riwayatbencana)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'desa_id' => 'required|exists:desa,id',
            'latitude' => 'nullable|string|max:100',
            'longitude' => 'nullable|string|max:100',
        ]);

        $request->merge([
            'tanggal' => Carbon::parse($request->tanggal)
        ]);

        $riwayatbencana->update($request->all());

        return redirect()->route('riwayat.index', $bencana);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatBencana  $riwayatbencana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bencana $bencana, RiwayatBencana $riwayatbencana)
    {
        $riwayatbencana->delete();

        return redirect()->route('riwayat.index', $bencana);
    }
}
