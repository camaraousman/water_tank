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

    //get datatable data
    public function fetchAll(Request $request){
        if ($request->ajax()) {
            if ($request->from_date != '' && $request->to_date != '') {
                $queries = DB::table('meter_open_close_logs')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $queries = DB::table('meter_open_close_logs')->orderBy('created_at', 'desc')->get();
            }

            //human readability
            foreach ($queries as $query){
                $user = User::where('id', '=', $query->user_id)->get()->first();
                $meter = Meter::where('id', '=', $query->meter_id)->get()->first();
                $query->switch = $query->switch == 0 ? "Motor Kapatma" : "Motor Açma";
                $query->status = $query->status == 0 ? "işlem başarısız" : "işlem başarılı";

                $query->user_id = $user->name;
                $query->meter_id = $meter->name;
            }


            return DataTables::of($queries)->make(true);
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
