<?php

namespace Database\Seeders;

use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatKekeringanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = Reader::createFromPath(__DIR__ . '/data/dat_riwayat_kekeringan.csv', 'r');
        $reader->setHeaderOffset(0);
        $records = collect($reader->getRecords())->map(function ($item) {
            $desa = DB::table('desa')->where('nama', $item['nama_desa'])->first();
            $date = new Carbon($item['tanggal']);
            return [
                'bencana_id' => $item['bencana_id'],
                'desa_id' => $desa ? $desa->id : null,
                'tanggal' => $date,
                'latitude' => $desa ? $desa->latitude : null,
                'longitude' => $desa ? $desa->longitude : null
            ];
        });
        DB::table('riwayat_bencana')->insert($records->all());
    }
}
