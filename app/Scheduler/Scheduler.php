<?php

namespace App\Scheduler;

use App\Models\Schedule;
use App\Scheduler\Specifications\HasMinutesHours;
use App\Scheduler\Specifications\HasMinutesHoursDays;
use App\Scheduler\Specifications\HasMinutesHoursDaysMonth;
use App\Scheduler\Specifications\HasMinutesHoursDaysMonthWeek;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Support\Facades\Cache;

class Scheduler
{
    use SetCurrentDateTrait;

    public const REPORT_CLASS = [
        1 => HasMinutesHours::class,
        2 => HasMinutesHoursDays::class,
        3 => HasMinutesHoursDaysMonth::class,
        4 => HasMinutesHoursDaysMonthWeek::class,
    ];

    public const CACHE_KEY = 'scheduledHourlyReports';

    public function builtReports(): void
    {
        $this->setDate();
        Schedule::cacheDailyScheduledReports($this->dayMonth, $this->month, $this->dayWeek, self::CACHE_KEY);
        $schedules = Cache::get(self::CACHE_KEY);

        foreach ($schedules as $schedule) {
            if ($this->validateSpecifications($schedule) === true) {
                print_r('A report with id ' . $schedule->report_id . ' was created');
            }
            continue;
        }
    }

    public function validateSpecifications(Schedule $schedule): bool
    {
        for ($i = 1; $i <= 4; $i++) {
            $specificationClass = self::REPORT_CLASS[$i];
            $specification = new $specificationClass($schedule);
            if ($specification->asQuery([]) === true) {
                return true;
            }
        }
        return false;
    }
}
