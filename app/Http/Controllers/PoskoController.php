<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\PosEvakuasi;

use Illuminate\Http\Request;
use function App\Helpers\getLastUpdatedData;

class PoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posko = PosEvakuasi::orderBy('nama')->paginate(5);

        $lastUpdatedTime = getLastUpdatedData(PosEvakuasi::class);

        return view('posko.index', compact('posko', 'lastUpdatedTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();

        return view('posko.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'desa_id' => 'required|exists:desa,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'latitude' => 'nullable|string|max:100',
            'longitude' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:255'
        ]);

        PosEvakuasi::create($request->all());

        return redirect()->route('posko.index')->with('success', 'Data posko evakuasi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PosEvakuasi  $posEvakuasi
     * @return \Illuminate\Http\Response
     */
    public function edit(PosEvakuasi $posevakuasi)
    {
        $posko = $posevakuasi;
        $kecamatan = Kecamatan::all();

        return view('posko.edit', compact('posko', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PosEvakuasi  $posEvakuasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosEvakuasi $posevakuasi)
    {
        $request->validate([
            'desa_id' => 'required|exists:desa,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'latitude' => 'nullable|string|max:100',
            'longitude' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:255'
        ]);

        $posevakuasi->update($request->all());

        return redirect()->route('posko.index')->with('success', 'Data posko evakuasi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PosEvakuasi  $posEvakuasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosEvakuasi $posevakuasi)
    {
        $posevakuasi->delete();

        return redirect()->route('posko.index')->with('success', 'Data posko evakuasi berhasil dihapus!');
    }
}
