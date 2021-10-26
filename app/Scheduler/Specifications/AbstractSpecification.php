<?php

namespace App\Scheduler\Specifications;

use App\Constants\Schedule as ScheduleConstant;
use Carbon\Carbon;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Validator;
use App\Scheduler\Contracts\Specification;

abstract class AbstractSpecification implements Specification
{
    protected Schedule $schedule;
    protected $minute;
    protected $hour;
    protected $month;
    protected $dayMonth;
    protected $dayWeek;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
        $this->minute = Carbon::now()->format('i');
        $this->hour = CarbonImmutable::now()->isoFormat('H');
        $this->month = CarbonImmutable::now()->isoFormat('M');
        $this->dayMonth = CarbonImmutable::now()->isoFormat('D');
        $this->dayWeek = CarbonImmutable::now()->weekday();

    }

    public function isSatisfyBy(string $minuteType, string $hourType, string $dayMonthType, string $monthType, string $dayWeekType): bool
    {
        $validate = Validator::make($this->schedule->getAttributes(), [
            ScheduleConstant::MINUTE => $minuteType,
            ScheduleConstant::HOUR => $hourType,
            ScheduleConstant::DAY_MONTH => $dayMonthType,
            ScheduleConstant::MONTH => $monthType,
            ScheduleConstant::DAY_WEEK => $dayWeekType,
        ]);

        return !$validate->fails();
    }

    public function asQuery(): bool
    {
    }
}
