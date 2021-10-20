<?php

namespace Tests\Concerns;

use App\Constants\Schedule as ScheduleConstants;

trait HasSchedulerProviders
{
    public function scheduledCronExpression(): array
    {
        return [
            'all days at 8 am the report will send' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20]
            ],

            'At every minute on day-of-month 9 a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::MINUTE => 20]
            ],

            'At every minute in December a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20]
            ],

            'At every minute on day-of-month 10 a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_WEEK => 5
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20
                ]
            ]
        ];
    }

    public function nonScheduledCronExpression(): array
    {
        return [
            'all days at 8 am the report will send' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 7,
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20]
            ],

            'At every minute on day-of-month 9 a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::DAY_MONTH => 8,
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 20,
                    ScheduleConstants::MINUTE => 20]
            ],

            'At every minute in December a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => 11,
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20]
            ],

            'At every minute on day-of-month 10 a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => 20,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_WEEK => 6
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 22,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 20
                ]
            ]
        ];
    }
}
