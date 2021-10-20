<?php

namespace App\Scheduler;

use App\Models\Schedule;
use App\Scheduler\Specifications\HasMinutesHours;
use App\Scheduler\Specifications\HasMinutesHoursDays;
use App\Scheduler\Specifications\HasMinutesHoursDaysMonth;
use App\Scheduler\Specifications\HasMinutesHoursDaysMonthWeek;

class Scheduler
{
    public const REPORT_CLASS = [
        1 => HasMinutesHours::class,
        2 => HasMinutesHoursDays::class,
        3 => HasMinutesHoursDaysMonth::class,
        4 => HasMinutesHoursDaysMonthWeek::class,
    ];

    public function builtReports()
    {
        $schedules = Schedule::all();
        foreach ($schedules as $schedule) {
            //TODO validate if this option is a good alternative
            /*if($schedule->crontype){
                new self::REPORT_CLASS[$schedule->crontype]($schedule);
            }*/
            if ($this->validateSpecifications($schedule) === true) {
                print_r('A report with id ' . $schedule->report_id . ' was created');
            }
            continue 1;
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
