<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use Illuminate\Http\Request;

class TankController extends Controller
{
    public function tank1_water_level(){
        $data = Tank::create([
            'name'       => 'tank 1',
            'water_level'   => rand(30,70),
        ]);

        $level = Tank::latest()->take(10)->get()->sortBy('id');
        $water_level = $level->pluck('water_level');

        return response()->json(compact( 'water_level'));
    }

    public function test(){
        $data = Tank::create([
            'name'       => 'tank 1',
            'water_level'   => rand(30,70),
        ]);



        return ($data->water_level);
    }
}
