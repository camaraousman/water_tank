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

    //get graph data
    public function getGraph(Request $request){
        switch ($request->id){
            case 0: //yearly
                $labels = ['ocak', 'şubat', 'mart', 'nisan', 'mayıs', 'haziran', 'temmuz', 'ağustos', 'eylül','ekim','kasım','aralık'];
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->startOfYear()->endOfMonth();

                list($tank_1, $tank_2) = $this->getAverage($start, $end, 0);
                break;
            case 1: //monthly
                $labels = ['1. hafta', '2. hafta', '3. hafta', '4. hafta'];
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->startOfMonth()->endOfWeek();

                list($tank_1, $tank_2) = $this->getAverage($start, $end, 1);
                break;
                //end monthly

            case 2: //weekly
                $labels = ['pazartesi', 'salı', 'çarsamba', 'perşembe', 'cuma', 'cumartesi', 'pazar'];
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->startOfWeek()->endOfDay();

                list($tank_1, $tank_2) = $this->getAverage($start, $end, 2);
                break;
                //end weekly

            case 3: //daily
                $labels = ['00.00-02.00', '02.00-04.00', '04.00-06.00', '06.00-08.00', '08.00-10.00', '10.00-12.00', '12.00-14.00',
                    '14.00-16.00', '16.00-18.00','18.00-20.00','20.00-22.00','22.00-24.00'];

                $start = Carbon::now()->startOfDay();
                $end = Carbon::now()->startOfDay()->addHours(2);

                list($tank_1, $tank_2) = $this->getAverage($start, $end, 3);
                break;
                //end daily

            default:
                $labels = ['No Available Data'];
                $tank_1=[];
                $tank_2=[];
        }

        return response()->json(compact('labels', 'tank_1', 'tank_2'));
    }

    public function getAverage($start, $end, $flag){
        $data_1 = array_fill(0, 12, 0);
        $data_2 = array_fill(0, 12, 0);

        if($flag == 0 || $flag == 3){
            $count = 12;
        }elseif ($flag == 1){
            $count = 4;
        }else{
            $count = 7;
        }

        for ($i=0; $i<$count; $i++){
            $avg1 = DB::table('tank_level_logs')
                ->where('tank_id', '=', 1)
                ->whereBetween('created_at', array($start, $end))
                ->avg('water_level');
            $avg2 = DB::table('tank_level_logs')
                ->where('tank_id', '=', 2)
                ->whereBetween('created_at', array($start, $end))
                ->avg('water_level');

            if ($avg1){
                $data_1[$i] = intval($avg1);
            }
            if ($avg2){
                $data_2[$i] = intval($avg2);
            }

            if($flag == 0 ){
                $start->addMonth();
                $end->addMonth();
            }elseif ($flag == 1){
                $start->addWeek();
                $end->addWeek();
            }elseif ($flag == 2){
                $start->addDay();
                $end->addDay();
            }else{
                $start->addHours(2);
                $end->addHours(2);
            }
        }

        return array($data_1, $data_2);
    }

//    public function getMax($start, $end, $flag){
//        $data_1 = array_fill(0, 12, 0);
//        $data_2 = array_fill(0, 12, 0);
//
//        if($flag == 0 || $flag == 3){
//            $count = 12;
//        }elseif ($flag == 1){
//            $count = 4;
//        }else{
//            $count = 7;
//        }
//
//        for ($i=0; $i<$count; $i++){
//            $avg1 = DB::table('tank_level_logs')
//                ->where('tank_id', '=', 1)
//                ->whereBetween('created_at', array($start, $end))
//                ->max('water_level');
//            $avg2 = DB::table('tank_level_logs')
//                ->where('tank_id', '=', 2)
//                ->whereBetween('created_at', array($start, $end))
//                ->max('water_level');
//
//            if ($avg1){
//                $data_1[$i] = intval($avg1);
//            }
//            if ($avg2){
//                $data_2[$i] = intval($avg2);
//            }
//
//            if($flag == 0 ){
//                $start->addMonth();
//                $end->addMonth();
//            }elseif ($flag == 1){
//                $start->addWeek();
//                $end->addWeek();
//            }elseif ($flag == 2){
//                $start->addDay();
//                $end->addDay();
//            }else{
//                $start->addHours(2);
//                $end->addHours(2);
//            }
//        }
//        return array($data_1, $data_2);
//    }

//    public function getMin($start, $end, $flag){
//        $data_1 = array_fill(0, 12, 0);
//        $data_2 = array_fill(0, 12, 0);
//
//        if($flag == 0 || $flag == 3){
//            $count = 12;
//        }elseif ($flag == 1){
//            $count = 4;
//        }else{
//            $count = 7;
//        }
//
//        for ($i=0; $i<$count; $i++){
//            $avg1 = DB::table('tank_level_logs')
//                ->where('tank_id', '=', 1)
//                ->whereBetween('created_at', array($start, $end))
//                ->min('water_level');
//            $avg2 = DB::table('tank_level_logs')
//                ->where('tank_id', '=', 2)
//                ->whereBetween('created_at', array($start, $end))
//                ->min('water_level');
//
//            if ($avg1){
//                $data_1[$i] = intval($avg1);
//            }
//            if ($avg2){
//                $data_2[$i] = intval($avg2);
//            }
//
//            if($flag == 0 ){
//                $start->addMonth();
//                $end->addMonth();
//            }elseif ($flag == 1){
//                $start->addWeek();
//                $end->addWeek();
//            }elseif ($flag == 2){
//                $start->addDay();
//                $end->addDay();
//            }else{
//                $start->addHours(2);
//                $end->addHours(2);
//            }
//        }
//        return array($data_1, $data_2);
//    }



}
