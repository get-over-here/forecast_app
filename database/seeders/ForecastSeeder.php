<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Location;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $locations = Location::all();
        DB::beginTransaction();
        foreach ($locations as $location) {
            $createdAt = Carbon::create('2000', '01', '01');
            for ($i=0; $i < 30 ; $i++) {
                DB::table('forecasts')->insert([
                    'location_id' => $location->id,
                    'datetime'    => $createdAt,
                    'hourly'      => rand(2000, 3000) / 100,
                ]);
                $createdAt->addHour();
            }
        }
        DB::commit();

    }
}
