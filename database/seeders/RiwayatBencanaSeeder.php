<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiwayatBencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RiwayatBanjirSeeder::class,
            RiwayatKekeringanSeeder::class,
            RiwayatAnginSeeder::class,
            RiwayatTanahLongsorSeeder::class
        ]);
    }
}
