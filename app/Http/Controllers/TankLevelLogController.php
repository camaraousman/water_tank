<?php

namespace App\Http\Controllers;

use App\Models\TankLevelLog;
use Illuminate\Http\Request;

class TankLevelLogController extends Controller
{
    public function index(){
        return view('pages.reports.tank_level_logs');
    }

    public function tank1_water_level(){
        TankLevelLog::create([
            'water_level'   => rand(30,70),
            'tank_id'       => 1
        ]);

        $level = TankLevelLog::latest()->take(30)->get()->sortBy('id');
//        $labels = $level->pluck('id');
        $data = $level->pluck('water_level');

        return response()->json(compact( 'data'));
    }

}
