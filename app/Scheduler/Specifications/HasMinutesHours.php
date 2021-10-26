<?php

namespace App\Scheduler\Specifications;

use App\Events\CreateScheduledReport;

class HasMinutesHours extends AbstractSpecification
{
    public function asQuery(): bool
    {
        if ($this->isSatisfyBy('numeric', 'numeric', 'in:*', 'in:*', 'in:*')) {
            if ($this->schedule->minute == $this->minute
                && $this->schedule->hour == $this->hour
            ) {
                event(new CreateScheduledReport($this->schedule));
                return true;
            }
            return false;
        }
        return false;
    }
}
