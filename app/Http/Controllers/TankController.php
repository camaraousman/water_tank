<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use App\Models\TankLevelLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TankController extends Controller
{
    public function tank1_water_level(){
        $data = TankLevelLog::create([
            'tank_id'       => 1,
            'water_level'   => rand(0,800),
        ]);

        $level = DB::table('tank_level_logs')->latest()->first();
        $water_level = $level->water_level;

        $str="&value=".$water_level;
        return $str;
    }

    public function tank2_water_level(){
        $data = TankLevelLog::create([
            'tank_id'       => 2,
            'water_level'   => rand(0,800),
        ]);

        $level = DB::table('tank_level_logs')->latest()->first();
        $water_level = $level->water_level;

        $str="&value=".$water_level;
        return $str;
    }

}
