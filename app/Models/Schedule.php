<?php

namespace App\Models;

use App\Constants\Schedule as ScheduleConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
      'minute',
      'hour',
      'day_month',
      'month',
      'day_week',
      'report_id',
    ];

    public $timestamps = false;

    public static function cacheDailyScheduledReports(string $dayMonth, string $month, string $dayWeek, string $cacheKey): void
    {
        Cache::remember($cacheKey, 86400, function () use ($dayMonth, $month, $dayWeek) {
            return self::whereIn(ScheduleConstant::DAY_MONTH, [$dayMonth, '*'])
            ->whereIn(ScheduleConstant::MONTH, [$month, '*'])
            ->whereIn(ScheduleConstant::DAY_WEEK, [$dayWeek, '*'])
            ->get();
        });
    }
}
