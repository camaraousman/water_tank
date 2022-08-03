<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterOpenCloseRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'meter_id',
        'switch',
        'requested_at'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
    public function meter(){
        $this->belongsTo(User::class);
    }
}
