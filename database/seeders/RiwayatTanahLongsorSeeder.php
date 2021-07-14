<?php

namespace Database\Seeders;

use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatTanahLongsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = Reader::createFromPath(__DIR__ . '/data/dat_riwayat_tanah_longsor.csv', 'r');
        $reader->setHeaderOffset(0);
        $records = collect($reader->getRecords())->map(function ($item) {
            $desa_id = DB::table('desa')->where('name', $item['nama_desa'])->value('id');
            $date = new Carbon($item['date']);
            return [
                'bencana_id' => $item['bencana_id'],
                'desa_id' => $desa_id,
                'date' => $date,
                'latitude' => $item['latitude'],
                'longitude' => $item['longitude']
            ];
        });
        DB::table('riwayat_bencana')->insert($records->all());
    }
}
