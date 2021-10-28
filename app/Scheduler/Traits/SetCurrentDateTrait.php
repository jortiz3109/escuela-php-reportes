<?php

namespace App\Scheduler\Traits;

use Carbon\Carbon;

trait SetCurrentDateTrait
{
    protected string $minute;
    protected string $hour;
    protected string $dayMonth;
    protected string $month;
    protected string $dayWeek;

    public function setDate(): void
    {
        $date = Carbon::now();
        $this->minute =$date->format('i');
        $this->hour = $date->isoFormat('H');
        $this->month = $date->isoFormat('M');
        $this->dayMonth = $date->isoFormat('D');
        $this->dayWeek = $date->weekday();
    }
}
