<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    use HasFactory;

    public $timestamps = false;

    public function scopeReportsToSchedule(Builder $query, array $date): Builder
    {
        $query = Schedule::select('report_id')
            ->where('minute', $date['minute'])
            ->orWhere('hour',  $date['hour'])
            ->orWhere('day_month',  $date['day_month'])
            ->orWhere('month',  $date['month'])
            ->orWhere('day_week',  $date['day_week']);
        return $query;
    }
}
