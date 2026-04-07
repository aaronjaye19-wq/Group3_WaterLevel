<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaterRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'depth',
        'temperature',
        'humidity',
        'pressure',
        'battery',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];
}
