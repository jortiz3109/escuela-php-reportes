<?php

namespace App\Scheduler\Specifications;

use App\Events\CreateScheduledReport;

class HasMinutesHoursDays extends AbstractSpecification
{
    public function asQuery(): bool
    {
        if ($this->isSatisfyBy('numeric', 'numeric', 'numeric', 'in:*', 'in:*' )){

            if (   $this->schedule->minute == $this->minute
                && $this->schedule->hour == $this->hour
                && $this->schedule->day_month == $this->dayMonth
            ) {
                event(new CreateScheduledReport($this->schedule));
                return true;
            }
            return false;
        }
        return false;
    }
}
