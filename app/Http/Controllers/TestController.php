<?php

namespace App\Http\Controllers;

use App\Models\TankLevelLog;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        list($arr1, $arr2) = $this->myfunction();

        dump($arr2);
    }

    public function myfunction(){
        $arr1 = [2,3,5,6];
        $arr2 = [2,5,6,6];

        return array($arr1, $arr2);
    }

    public function fetch_data(Request $request){

    }
}

