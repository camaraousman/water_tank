<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=2; $i++){
            \App\Models\Tank::create([
                'name'               => 'Tank'." ". $i,
                'water_level'        => 0,
                'last_updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
