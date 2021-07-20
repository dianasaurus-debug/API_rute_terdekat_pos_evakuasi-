<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use Illuminate\Http\Request;

use App\Models\LaporanBencana;
use function App\Helpers\getLastUpdatedData;
use function GuzzleHttp\Promise\all;

class LabenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laben = LaporanBencana::latest()->paginate(10);

        $lastUpdatedTime = getLastUpdatedData(LaporanBencana::class);

        return view('laben.index', compact('laben', 'lastUpdatedTime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanBencana $laporanbencana)
    {
        $laben = $laporanbencana;
        $bencana = Bencana::all();

        return view('laben.edit', compact('laben', 'bencana'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanBencana $laporanbencana)
    {
        $request->validate([
            'bencana_id' => 'required|exists:bencana,id',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
        ]);

        $laporanbencana->update($request->all());

        return redirect()->route('laben.index')->with('success', 'Data laporan bencana berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanBencana $laporanbencana)
    {
        $laporanbencana->delete();

        return redirect()->route('laben.index')->with('success', 'Data laporan bencana berhasil dihapus!');
    }
}
