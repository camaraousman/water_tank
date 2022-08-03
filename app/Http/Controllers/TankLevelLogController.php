<?php

namespace App\Http\Controllers;

use App\Models\TankLevelLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TankLevelLogController extends Controller
{
    public function index(){
        return view('pages.reports.tank_level_logs');
    }

    public function fetchAll(Request $request){
        if ($request->ajax()) {
            if ($request->from_date != '' && $request->to_date != '') {
                $data = DB::table('tank_level_logs')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('tank_level_logs')->orderBy('created_at', 'desc')->get();
            }
            return DataTables::of($data)->make(true);
        }
    }

    public function store(Request $request){
        $message='';
        $status=-1;

        try {
            TankLevelLog::create([
                'tank_id'     => $request->TANK_ID,
                'water_level' => $request->WATER_LEVEL,
            ]);

            $message = "success";
            $status = 1;
        }catch (\Illuminate\Database\QueryException $ex){
            $message = $ex->getMessage();
        }

        return response()->json([
            "MESSAGE"        => $message,
            "STATUS"         => $status
        ]);
    }

}
