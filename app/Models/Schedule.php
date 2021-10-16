<?php

namespace App\Models;

use App\Constants\Schedule as Constants;
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
            ->where(Constants::MINUTE, $date[Constants::MINUTE])
            ->orWhere(Constants::HOUR,  $date[Constants::HOUR])
            ->orWhere(Constants::DAY_MONTH,  $date[Constants::DAY_MONTH])
            ->orWhere(Constants::MONTH,  $date[Constants::MONTH])
            ->orWhere(Constants::DAY_WEEK,  $date[Constants::DAY_WEEK]);
        return $query;
    }
}
