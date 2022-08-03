<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterOpenCloseLog extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'meter_id',
      'switch',
      'status',
      'requested_at',
      'action_at',
    ];
}
