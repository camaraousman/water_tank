<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'status'
    ];

    protected $table = 'meters';

    public static function getLength(){
        return Meter::all()->count();
    }
    public static function getName($id){
        $meter = Meter::where('id', '=', $id)->get()->first();
        return $meter->name;
    }
    public static function isOn($id){
        $meter = Meter::where('id', '=', $id )->get()->first();

        if ($meter->status == 1){
            return true;
        }

        return false;
    }
}
