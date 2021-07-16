<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;

use Illuminate\Http\Request;
use function App\Helpers\getLastUpdatedData;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::orderBy('nama')->paginate(5);

        $lastUpdatedTime = getLastUpdatedData(Desa::class);

        return view('desa.index', compact('desa', 'lastUpdatedTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::orderBy('nama')->get(['id', 'nama']);

        return view('desa.create', compact('kecamatan'));
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
            'nama' => 'required|string|max:50|unique:desa,nama,NULL,id,kecamatan_id,' . $request->kecamatan_id,
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
        ]);

        Desa::create($request->all());

        return redirect()->route('desa.index')->with('success', 'Data desa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        $kecamatan = Kecamatan::orderBy('nama')->get(['id', 'nama']);

        return view('desa.edit', compact('desa', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'nama' => 'required|string|max:50|unique:desa,nama,' . $desa->id . ',id,kecamatan_id,' . $request->kecamatan_id,
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
        ]);

        $desa->update($request->all());

        return redirect()->route('desa.index')->with('success', 'Data desa berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        $desa->delete();

        return redirect()->route('desa.index')->with('success', 'Data desa berhasil dihapus!');
    }
}
