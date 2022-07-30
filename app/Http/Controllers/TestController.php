<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }

    public function fetch_data(Request $request){
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
