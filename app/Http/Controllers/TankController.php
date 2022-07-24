<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use Illuminate\Http\Request;

class TankController extends Controller
{
    public function tank1_water_level(){
       $tank1 = Tank::where('id', '=', 1)->get()->first();
       $str =  $tank1->water_level;
        echo"$str";
    }
}
