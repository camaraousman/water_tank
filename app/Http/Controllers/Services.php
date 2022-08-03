<?php

namespace App\Http\Controllers;

use App\Models\MeterOpenCloseLog;
use App\Models\MeterOpenCloseRequest;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Services extends Controller
{
    public function switch(){
        $message = '';
        $status = -1;
        $switch = -1;

        try{
            DB::beginTransaction();

            //delete timeout requests
            $timeout = Carbon::now()->subMinute(2);
            $timeout_results = MeterOpenCloseRequest::where('requested_at', '<', $timeout)->get()->all();

            foreach ($timeout_results as $timeout_result){
                MeterOpenCloseLog::create([
                    'user_id'       => $timeout_result->user_id,
                    'meter_id'       => $timeout_result->user_id,
                    'switch'        => $timeout_result->switch,
                    'status'        => 0,       //timed out records
                    'requested_at'  => $timeout_result->requested_at,
                    'action_at'     => Carbon::now()->format('Y-m-d H:i:s'), //no action tbh but to be considered time sent to log
                ]);
            }
            MeterOpenCloseRequest::where('requested_at', '<', $timeout)->delete();

            //handle meter open/close requests
            $last_request = MeterOpenCloseRequest::get()->first();

            if($last_request != NULL){
                $switch = $last_request->switch;
                MeterOpenCloseLog::create([
                    'user_id'       => $last_request->user_id,
                    'meter_id'       => $last_request->meter_id,
                    'switch'        => $last_request->switch,
                    'status'        => 1,       //executed records
                    'requested_at'  => $last_request->requested_at,
                    'action_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                MeterOpenCloseRequest::where('id', '=', $last_request['id'])->delete();
            }
            DB::commit();
            $message = 'success';
            $status = 1;
        }catch (QueryException $ex){
            $message = $ex->getMessage();
            DB::rollBack();
        }

        return response()->json([
            'MESSAGE'   => $message,
            'STATUS'    => $status,
            'SWITCH'    =>$switch,
        ]);
    }
}
