<?php

namespace Database\Seeders;

use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SOPAnginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = Reader::createFromPath(__DIR__ . '/data/dat_sop_angin.csv', 'r');
        $reader->setHeaderOffset(0);
        $records = collect($reader->getRecords())->map(function ($item) {
            return collect($item)->except(['id'])->toArray();
        });
        DB::table('sop_bpbd')->insert($records->all());
    }
}
