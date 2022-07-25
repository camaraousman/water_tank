<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TankLevelLogController extends Controller
{
    public function index(){
        return view('reports.water_logs');
    }
}
