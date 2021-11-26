<?php

namespace App\Scheduler\Specifications;

class CronReportShouldBeRun extends AbstractCronSpecification
{
    protected string $cronRegex = 'regex:/^(?:[0-9]{1,2}|[*])$/';

    public function evaluateSatisfied(): bool
    {
        return $this->itSatisfiedACronExpression('numeric', $this->cronRegex, $this->cronRegex, $this->cronRegex, $this->cronRegex);
    }

    public function isCurrentTime(): bool
    {
        $this->setDate();
        return $this->schedule->minute == $this->minute
            && $this->schedule->hour == $this->hour;
    }

    public function shouldExecuteReport(): bool
    {
        return $this->evaluateSatisfied() && $this->isCurrentTime();
    }
}
