<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
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
     * @return \Illuminate\Http\Response
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

        $bencana->riwayatBencana()->create($request->all());

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
