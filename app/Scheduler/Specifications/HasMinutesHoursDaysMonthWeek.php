<?php

namespace App\Scheduler\Specifications;

use App\Events\CreateScheduledReport;

class HasMinutesHoursDaysMonthWeek extends AbstractSpecification
{
    public function asQuery(): bool
    {
        if ($this->isSatisfyBy('numeric', 'numeric', 'numeric', 'numeric', 'numeric')) {

            if (   $this->schedule->minute == $this->minute
                && $this->schedule->hour == $this->hour
                && $this->schedule->day_month == $this->dayMonth
                && $this->schedule->month == $this->month
                && $this->schedule->day_week == $this->dayWeek
            ) {
                event(new CreateScheduledReport($this->schedule));
                return true;
            }
            return false;
        }
        return false;
    }
}
