<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $locations = [
            ['NewYork' , '40.730610' , '-73.935242'],
            ['London'  , '51.509865' , '-0.118092' ],
            ['Paris'   , '48.864716' , '2.349014'  ],
            ['Berlin'  , '52.520008' , '13.404954' ],
            ['Tokyo'   , '35.652832' , '139.839478'],
        ];

        DB::beginTransaction();

        foreach ($locations as $location) {
            DB::table('locations')->insert([
                'name'      => $location[0],
                'latitude'  => $location[1],
                'longitude' => $location[2],
            ]);
        }

        DB::commit();
    }
}
