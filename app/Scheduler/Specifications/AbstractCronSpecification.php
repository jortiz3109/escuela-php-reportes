<?php

namespace App\Scheduler\Specifications;

use App\Constants\Schedule as ScheduleConstant;
use App\Models\Schedule;
use App\Scheduler\Contracts\CronSpecification;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Support\Facades\Validator;

abstract class AbstractCronSpecification implements CronSpecification
{
    use SetCurrentDateTrait;
    protected Schedule $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function itSatisfiedACronExpression(string $minuteType, string $hourType, string $dayMonthType, string $monthType, string $dayWeekType): bool
    {
        $validate = Validator::make($this->schedule->getAttributes(), [
            ScheduleConstant::MINUTE => ['required', $minuteType],
            ScheduleConstant::HOUR => ['required', $hourType],
            ScheduleConstant::DAY_MONTH => ['required', $dayMonthType],
            ScheduleConstant::MONTH => ['required', $monthType],
            ScheduleConstant::DAY_WEEK => ['required', $dayWeekType],
        ]);
        return !$validate->fails();
    }
}
