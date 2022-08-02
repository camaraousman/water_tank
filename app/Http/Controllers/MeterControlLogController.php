<?php

namespace App\Http\Controllers;

use App\DataTables\MeterControlLogsDatatables;
use App\Models\MeterControlLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MeterControlLogController extends Controller
{
    public function index(MeterControlLogsDatatables $meterControlLogsDatatables){
        return $meterControlLogsDatatables->render('pages.reports.meter_control_logs');
    }

    public function fetchAll(Request $request){
        if ($request->ajax()) {
            if ($request->from_date != '' && $request->to_date != '') {
                $data = DB::table('meter_control_logs')
                    ->whereBetween('action_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('meter_control_logs')->orderBy('action_at', 'desc')->get();
            }
            return DataTables::of($data)->make(true);
        }
    }
}
