<?php

namespace App\Scheduler\Contracts;

use App\Models\Schedule;

interface Specification
{
    public function __construct(Schedule $schedule);

    public function isSatisfyBy(string $minuteType, string $hourType, string $dayMonthType, string $monthType, string $dayWeekType): bool;

    public function asQuery(): bool;
}
