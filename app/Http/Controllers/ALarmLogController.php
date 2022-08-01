<?php

namespace App\Http\Controllers;

use App\Models\AlarmLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ALarmLogController extends Controller
{
    public function index(){
        return view('pages.reports.alarm_logs');
    }

    public function fetchAll(Request $request){
        if ($request->ajax()) {
            if ($request->from_date != '' && $request->to_date != '') {
                $data = DB::table('alarm_logs')
                    ->whereBetween('action_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('alarm_logs')->orderBy('created_at', 'desc')->get();
            }
            echo json_encode($data);
        }
    }
}
