<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SOPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SOPBanjirSeeder::class,
            SOPKekeringanSeeder::class,
            SOPAnginSeeder::class,
            SOPTanahLongsorSeeder::class
        ]);
    }
}
