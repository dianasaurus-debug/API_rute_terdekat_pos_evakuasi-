<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

use function App\Helpers\getLastUpdatedData;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->query('cari')) {
            $kecamatan = Kecamatan::where(
                'nama', 'like', 
                '%' . request()->query('cari') . '%'
            )->orderBy('nama')->paginate(5)->appends(request()->query());
        } else {
            $kecamatan = Kecamatan::orderBy('nama')->paginate(5);
        }

        $lastUpdatedTime = getLastUpdatedData(Kecamatan::class);

        return view('kecamatan.index', compact('kecamatan', 'lastUpdatedTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kecamatan.create');
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
            'nama' => 'required|unique:kecamatan,nama|string|max:100',
            'latitude' => 'nullable|string|max:100',
            'longitude' => 'nullable|string|max:100',
        ]);

        Kecamatan::create($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'Data kecamatan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        return view('kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kecamatan,nama,' . $kecamatan->id,
            'latitude' => 'nullable|string|max:100',
            'longitude' => 'nullable|string|max:100',
        ]);

        $kecamatan->update($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'Data kecamatan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'Data kecamatan berhasil dihapus!');
    }
}
