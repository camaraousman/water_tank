<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone_number',
    ];

    public function getData()
    {
        return static::orderBy('created_at','desc')->get();
    }
}
