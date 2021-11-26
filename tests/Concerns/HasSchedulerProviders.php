<?php

namespace Tests\Concerns;

use App\Constants\Schedule as ScheduleConstants;
use App\Scheduler\Specifications\CronReportShouldBeRun;

trait HasSchedulerProviders
{

    public function setDataCronJob(string $minute, string $hour, string $dayMonth, string $month, string $dayWeek): array
    {
        return [
            ScheduleConstants::MINUTE => $minute,
            ScheduleConstants::HOUR => $hour,
            ScheduleConstants::DAY_MONTH => $dayMonth,
            ScheduleConstants::MONTH => $month,
            ScheduleConstants::DAY_WEEK => $dayWeek,
        ];
    }

    public function setDataSetTime(string $year, string $month, string $dayMonth, string $hour, string $minute): array
    {
        return [
            ScheduleConstants::YEAR => $year,
            ScheduleConstants::MONTH => $month,
            ScheduleConstants::DAY_MONTH => $dayMonth,
            ScheduleConstants::HOUR => $hour,
            ScheduleConstants::MINUTE => $minute,
        ];

    }

    public function scheduledCronExpression(): array
    {
        return [
            'all days at specific minute and hour a report will be execute' => [
                $this->setDataCronJob(20, 8, '*', '*', '*'),
                $this->setDataSetTime(2021, 10, 22, 8, 20),
            ],
            'at specific day with hour and minute a report will be execute' => [
                $this->setDataCronJob(20, 20, 9, '*', '*'),
                $this->setDataSetTime(2021, 10, 9, 20, 20)
            ],

            'at specific month with day, hour and minute a report will be execute' => [
                $this->setDataCronJob(20, 8, 9, 10, '*'),
                $this->setDataSetTime(2021, 10, 9, 8, 20)
            ],

            'at specific week day with month, day, hour and minute a report will be execute' => [
                $this->setDataCronJob(20, 8, 22, 10, 5),
                $this->setDataSetTime(2021, 10, 22, 8, 20)
            ],
        ];
    }

    public function nonScheduledCronExpression(): array
    {
        return [
            'all days at specific minute and hour a report will not be execute' => [
                $this->setDataCronJob(20, 7, '*', '*', '*'),
                $this->setDataSetTime(2021, 10, 22, 8, 20)
            ],

            'at specific day with hour and minute a report will not be execute' => [
                $this->setDataCronJob(20, 20, 8, '*', '*'),
                $this->setDataSetTime(2021, 10, 9, 8, 20)
            ],

            'at specific month with day, hour and minute a report will not be execute' => [
                $this->setDataCronJob(20, 8, 9, 11, '*'),
                $this->setDataSetTime(2021, 10, 9, 8, 20)
            ],

            'at specific week day with month, day, hour and minute a report will not be execute' => [
                $this->setDataCronJob(20, 8, 22, 10, 5),
                $this->setDataSetTime(2021, 10, 22, 8, 20)
            ],

        ];
    }

    public function schedulerSpecificationsSuccessTest(): array
    {
        return [
            'Current specification compatibility CronReportShouldBeRun' => [
                'specification' => [
                    'specification_class' => CronReportShouldBeRun::class,
                ],
                'schedule' => [
                    ScheduleConstants::MINUTE => 50,
                    ScheduleConstants::HOUR => 10,
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*',
                ],
            ],
        ];
    }

    public function schedulerSpecificationsFailTest(): array
    {
        return [
            'Current specification compatibility CronReportShouldBeRun' => [
                'specification' => [
                    'specification_class' => CronReportShouldBeRun::class,
                ],
                'schedule' => [
                    ScheduleConstants::MINUTE => 10,
                    ScheduleConstants::HOUR => null,
                    ScheduleConstants::DAY_MONTH => 50,
                    ScheduleConstants::MONTH => null,
                    ScheduleConstants::DAY_WEEK => null,
                ],
            ],

        ];
    }
}
