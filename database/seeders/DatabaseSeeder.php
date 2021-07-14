<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BencanaSeeder::class,
            SOPSeeder::class,
            KecamatanSeeder::class,
            DesaSeeder::class,
            PosEvakuasiSeeder::class,
            RiwayatBencanaSeeder::class
        ]);
    }
}
