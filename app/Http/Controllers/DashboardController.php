<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use Carbon\Carbon;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\LaporanBantuan;
use App\Models\LaporanBencana;

use App\Models\RiwayatBencana;
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

        $riwayat = $this->getRiwayat(request()->query('bencana'));

        return view('home', compact('data', 'riwayat'));
    }

    private function getRiwayat($bencana_slug)
    {
        $bencana = Bencana::where('slug', $bencana_slug)->first();
        if ($bencana == null) {
            $bencana = Bencana::where('slug', 'banjir')->first();
        }

        $riwayat = [];
        $data_riwayat = $bencana->riwayatBencana()
            ->orderBy('tanggal', 'desc')
            ->get();

        $tahun = null;
        foreach ($data_riwayat as $key => $item) {
            $desa = $item->desa;
            $kecamatan = $desa ? $item->desa->kecamatan : null;
            $tanggal = new Carbon($item->tanggal);
            $jml_hari = $tanggal->diffInDays(Carbon::now());
            $jumlah = $bencana->riwayatBencana()->whereYear('tanggal', $tanggal->year)->count();

            $riwayat[$key] = [
                'bencana' => $item->bencana->nama,
                'desa' => $desa ? $desa->nama : '-',
                'kecamatan' => $kecamatan ? $kecamatan->nama : '-',
                'latitude' => $item->latitude ?: '-',
                'longitude' => $item->longitude ?: '-',
                'status' => ($jml_hari <= 30) ? 'BARU' : 'LAMA',
                'tahun' => $tanggal->year != $tahun ? $tanggal->year : null,
                'jumlah' => $tanggal->year != $tahun ? $jumlah : null
            ];

            $tahun = $tanggal->year;
        }

        return $riwayat;
    }
}
