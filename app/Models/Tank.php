<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasFactory;
    protected $dates = [
        'last_updated_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'water_level',
        'last_updated_at',
        'created_at',
        'updated_at',
    ];
}
