<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ALarmLogController extends Controller
{
    public function index(){
        return view('pages.reports.alarm_logs');
    }
}
