<?php

namespace App\Scheduler\Contracts;

use App\Models\Schedule;

interface CronSpecification
{
    public function __construct(Schedule $schedule);

    public function itSatisfiedACronExpression(string $minuteType, string $hourType, string $dayMonthType, string $monthType, string $dayWeekType): bool;

    public function shouldExecuteReport(): bool;
}
