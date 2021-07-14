<?php

namespace Database\Seeders;

use League\Csv\Reader;
use League\Csv\Statement;
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

        $records = (new Statement())->process($reader);

        DB::table('bencana')->insert($records->jsonSerialize());
    }
}
