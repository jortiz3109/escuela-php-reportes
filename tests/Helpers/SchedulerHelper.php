<?php

namespace Tests\Helpers;

use App\Constants\Commands;
use App\Constants\Schedule as ScheduleConstant;
use App\Models\Report;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

trait SchedulerHelper
{
    protected Model $report;
    protected Model $schedule;

    public function setCurrentTime(int $year, int $month, int $day, int $hour, int $minute): void
    {
        $knownDate = Carbon::create($year, $month, $day, $hour, $minute);
        Carbon::setTestNow($knownDate);
    }

    public function createSchedule(array $cronExpression): Schedule
    {
        return Schedule::create([
            ScheduleConstant::MINUTE => $cronExpression[ScheduleConstant::MINUTE],
            ScheduleConstant::HOUR => $cronExpression[ScheduleConstant::HOUR] ?: '*',
            ScheduleConstant::DAY_MONTH => $cronExpression[ScheduleConstant::DAY_MONTH] ?: '*',
            ScheduleConstant::MONTH => $cronExpression[ScheduleConstant::MONTH] ?: '*',
            ScheduleConstant::DAY_WEEK => $cronExpression[ScheduleConstant::DAY_WEEK] ?: '*',
            'report_id' => Report::create()->id,
        ]);
    }

    public function createTestScenario(): void
    {
        $this->setCurrentTime(2021, 3, 4, 15, 22);
        $this->setDate();
        $this->report = Report::factory()->create();
        $this->schedule = Schedule::factory()->create([
                ScheduleConstant::MINUTE => $this->minute,
                ScheduleConstant::HOUR => $this->hour,
                ScheduleConstant::DAY_MONTH => $this->dayMonth,
                ScheduleConstant::MONTH => $this->month,
                ScheduleConstant::DAY_WEEK => $this->dayWeek,
                'report_id' => $this->report->id,
            ]);
        $this->setCurrentTime(2021, 3, 4, 00, 00);
        $this->artisan(Commands::CACHE_REPORTS_CALL);
    }
}
