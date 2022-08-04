<?php

namespace App\Http\Controllers;

use App\DataTables\MeterControlLogsDatatables;
use App\Models\Meter;
use App\Models\MeterControlLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MeterControlLogController extends Controller
{
    public function index(MeterControlLogsDatatables $meterControlLogsDatatables){
        return $meterControlLogsDatatables->render('pages.reports.meter_open_close_logs');
    }

    public function fetchAll(Request $request){


        if ($request->ajax()) {
            if ($request->from_date != '' && $request->to_date != '') {
                $data = DB::table('meter_open_close_logs')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('meter_open_close_logs')->orderBy('created_at', 'desc')->get();
            }

            return DataTables::of($data)->make(true);
        }
    }

    public function store(Request $request){
        $message='';
        $status=-1;

        try {
            MeterControlLog::create([
                'slug'          => $request->SLUG,
                'desc'          => $request->DESC,
                'requested_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                'action_at'  => Carbon::now()->format('Y-m-d H:i:s'),
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
