<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Bencana;

use Illuminate\Http\Request;
use App\Models\LaporanBantuan;
use function App\Helpers\getLastUpdatedData;

class LabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laban = LaporanBantuan::latest()->paginate(10);

        $lastUpdatedTime = getLastUpdatedData(LaporanBantuan::class);

        return view('laban.index', compact('laban', 'lastUpdatedTime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanBantuan  $laporanBantuan
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanBantuan $laporanbantuan)
    {
        $laban = $laporanbantuan;
        $bencana = Bencana::all();
        $bantuan = Bantuan::all();

        return view('laban.edit', compact('laban', 'bencana', 'bantuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanBantuan  $laporanBantuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanBantuan $laporanbantuan)
    {
        $request->validate([
            'bencana_id' => 'required|exists:bencana,id',
            'bantuan_id' => 'nullable|exists:bantuan,id',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
        ]);

        $laporanbantuan->update($request->all());

        return redirect()->route('laban.index')->with('success', 'Data laporan bantuan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanBantuan  $laporanBantuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanBantuan $laporanbantuan)
    {
        $laporanbantuan->delete();

        return redirect()->route('laban.index')->with('success', 'Data laporan bantuan berhasil dihapus!');

    }
}
