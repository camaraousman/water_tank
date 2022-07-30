<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterControlLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'desc',
        'requested_at',
        'action_at',
        'status'
    ];
}
