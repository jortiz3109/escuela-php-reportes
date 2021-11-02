<?php

namespace Tests\Concerns;

use App\Constants\Schedule as ScheduleConstants;
use App\Scheduler\Specifications\CronReportShouldBeRun;

trait HasSchedulerProviders
{
    public function scheduledCronExpression(): array
    {
        return [
            'all days at specific minute and hour a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*',
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20, ],
            ],

            'at specific day with hour and minute a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*',
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::MINUTE => 20, ],
            ],

            'at specific month with day, hour and minute a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_WEEK => '*',
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20, ],
            ],

            'at specific week day with month, day, hour and minute a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_WEEK => 5,
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20,
                ],
            ],
        ];
    }

    public function nonScheduledCronExpression(): array
    {
        return [
            'all days at specific minute and hour a report will not be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 7,
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*',
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20, ],
            ],

            'at specific day with hour and minute a report will not be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::DAY_MONTH => 8,
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*',
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::MINUTE => 20, ],
            ],

            'at specific month with day, hour and minute a report will not be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => 11,
                    ScheduleConstants::DAY_WEEK => '*',
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20, ],
            ],

            'at specific week day with month, day, hour and minute a report will not be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_WEEK => 5,
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 21,
                ],
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
