<?php

namespace App\Http\Controllers;

use App\Models\LaporanBencana;
use Illuminate\Http\Request;

use function App\Helpers\getLastUpdatedData;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanBencana $laporanBencana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanBencana $laporanBencana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanBencana $laporanBencana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanBencana  $laporanBencana
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanBencana $laporanBencana)
    {
        //
    }
}
