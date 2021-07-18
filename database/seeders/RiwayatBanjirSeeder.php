<?php

namespace Database\Seeders;

use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatBanjirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = Reader::createFromPath(__DIR__ . '/data/dat_riwayat_banjir.csv', 'r');
        $reader->setHeaderOffset(0);
        $records = collect($reader->getRecords())->map(function ($item) {
            $desa_id = DB::table('desa')->where('nama', $item['nama_desa'])->value('id');
            $date = new Carbon($item['tanggal']);
            return [
                'bencana_id' => $item['bencana_id'],
                'desa_id' => $desa_id,
                'tanggal' => $date,
                'latitude' => $item['latitude'],
                'longitude' => $item['longitude']
            ];
        });
        DB::table('riwayat_bencana')->insert($records->all());
    }
}
