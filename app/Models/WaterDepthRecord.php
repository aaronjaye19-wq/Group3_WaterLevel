<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WaterDepthRecord extends Model
{
    protected $fillable = [
        'water_level',
        'temperature',
        'date',
        'change_24h',
        'maximum_24h',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get records for a specific date range
     */
    public static function getByDateRange($startDate, $endDate)
    {
        return self::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();
    }

    /**
     * Get latest record
     */
    public static function getLatest()
    {
        return self::orderBy('date', 'desc')->first();
    }

    /**
     * Get records for last N days
     */
    public static function getLastDays($days = 7)
    {
        return self::whereBetween('date', [
            Carbon::now()->subDays($days)->startOfDay(),
            Carbon::now()->endOfDay()
        ])->orderBy('date', 'asc')->get();
    }

    /**
     * Get daily statistics
     */
    public static function getDailyStats($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();
        
        return self::where('date', $date->format('Y-m-d'))
            ->first();
    }
}
