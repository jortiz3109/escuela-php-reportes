<?php

namespace App\Scheduler\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

trait SetCurrentDateTrait
{
    protected string $minute;
    protected string $hour;
    protected string $dayMonth;
    protected string $month;
    protected string $dayWeek;

    public function setDate($model): void
    {
        $model->minute = Carbon::now()->format('i');
        $model->hour = CarbonImmutable::now()->isoFormat('H');
        $model->month = CarbonImmutable::now()->isoFormat('M');
        $model->dayMonth = CarbonImmutable::now()->isoFormat('D');
        $model->dayWeek = CarbonImmutable::now()->weekday();
    }
}
