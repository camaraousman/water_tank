<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlarmRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'desc',
        'requested_at'
    ];
}
