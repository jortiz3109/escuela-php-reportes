<?php

namespace App\Scheduler\Specifications;

use App\Events\CreateScheduledReport;

class HasMinutesHoursDaysMonth extends AbstractSpecification
{
    public function asQuery(): bool
    {
        if ($this->isSatisfyBy('numeric', 'numeric', 'numeric', 'numeric', 'in:*')) {

            if (   $this->schedule->minute == $this->minute
                && $this->schedule->hour == $this->hour
                && $this->schedule->day_month == $this->day_month
                && $this->schedule->month == $this->month
            ) {
                event(new CreateScheduledReport($this->schedule));
                return true;
            }
            return false;
        }
        return false;
    }
}
