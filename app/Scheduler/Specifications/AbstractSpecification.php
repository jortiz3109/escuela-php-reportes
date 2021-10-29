<?php

namespace App\Scheduler\Specifications;

use App\Constants\Schedule as ScheduleConstant;
use App\Models\Schedule;
use App\Scheduler\Contracts\Specification;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Support\Facades\Validator;

abstract class AbstractSpecification implements Specification
{
    use SetCurrentDateTrait;
    protected Schedule $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function isSatisfyBy(string $minuteType, string $hourType, string $dayMonthType, string $monthType, string $dayWeekType): bool
    {
        $this->setDate();
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
