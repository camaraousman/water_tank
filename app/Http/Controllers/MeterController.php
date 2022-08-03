<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use App\Models\MeterOpenCloseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    public function open_close_meter(Request $request, $id){
        $meter = Meter::where('id', '=', $id)->get()->first();
        $currentStatus = $meter->status;
        $newStatus = 1-$currentStatus;

        $meter->update([
            'status' => $newStatus
        ]);

        MeterOpenCloseRequest::create([
            'user_id'   => $request->user()->id,
            'meter_id'  => $id,
            'switch'    => $currentStatus,
            'requested_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect('/');
    }
}
