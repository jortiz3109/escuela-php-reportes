<?php

namespace App\Models;

use App\Constants\Schedule as ScheduleConstant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
      'minute',
      'hour',
      'day_month',
      'month',
      'day_week',
      'report_id'
    ];

    public $timestamps = false;

    public static function cacheDailyScheduledReports(string $dayMonth, string $month, string $dayWeek, string $cacheKey)
    {
        if (Cache::has($cacheKey)){
            Cache::forget($cacheKey);
        }

        Cache::remember($cacheKey, 60, function () use ($dayMonth, $month, $dayWeek){
            return Schedule::whereIn(ScheduleConstant::DAY_MONTH, [$dayMonth, '*'])
            ->whereIn(ScheduleConstant::MONTH, [$month, '*'])
            ->whereIn(ScheduleConstant::DAY_WEEK, [$dayWeek, '*'])
            ->get();
        });
    }
}
