<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\LaporanBantuan;
use App\Models\LaporanBencana;

use function App\Helpers\getLastUpdatedData;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $data = [
            'desa' => [
                Desa::count(), getLastUpdatedData(Desa::class)
            ],
            'kecamatan' => [
                Kecamatan::count(), getLastUpdatedData(Kecamatan::class)
            ],
            'lap_bencana' => [
                LaporanBencana::count(), getLastUpdatedData(LaporanBencana::class)
            ],
            'lap_bantuan' => [
                LaporanBantuan::count(), getLastUpdatedData(LaporanBantuan::class)
            ],
        ];

        return view('home', compact('data'));
    }
}
