<?php

namespace App\Http\Controllers;

use App\Models\MeterControlLog;
use Illuminate\Http\Request;

class MeterControlLogController extends Controller
{
    public function index(){
        return view('pages.reports.meter_control_logs');
    }

    public function fetchAll(){
        MeterControlLog::create(['speed' => rand(30,70)]);

        $speeds = MeterControlLog::latest()->take(30)->get()->sortBy('id');
        $labels = $speeds->pluck('id');
        $data = $speeds->pluck('speed');

        return response()->json(compact('labels', 'data'));
    }
}
