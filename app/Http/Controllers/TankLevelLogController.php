<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TankLevelLogController extends Controller
{
    public function index(){
        return view('pages.reports.tank_level_logs');
    }
}
