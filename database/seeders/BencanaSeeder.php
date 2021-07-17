<?php

namespace Database\Seeders;

use League\Csv\Reader;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = Reader::createFromPath(__DIR__ . '/data/dat_bencana.csv', 'r');
        $reader->setHeaderOffset(0);

        $records = collect($reader->getRecords())->map(function ($item) {
            return collect($item)->put('slug', Str::slug($item['nama']))->toArray();
        });
        DB::table('bencana')->insert($records->all());
    }
}
