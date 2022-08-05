<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        $data = DB::table('meter_open_close_logs')->orderBy('created_at', 'desc')->get();

        $objs = $data;



        dump(count($data));
        dump($objs);
    }

    public function fetch_data(Request $request){

    }
}

class Profile{
    public $name;
    public $surname;
}
