<?php

namespace Tests\Unit\Scheduler\Specifications;

use App\Constants\Schedule as ScheduleConstant;
use Tests\TestCase;
use App\Models\Report;
use App\Models\Schedule;
use Illuminate\Support\Carbon;
use Tests\Concerns\HasSchedulerProviders;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecificationsTest extends TestCase
{
    use RefreshDatabase;
    use SetCurrentDateTrait;
    use HasSchedulerProviders;

    /**
     *
     * @test
     * @dataProvider schedulerSpecificationsSuccessTest
     * @param $specification
     * @param $schedule
     */
    public function specification_must_return_true_for_schedule_compatibility($specification, $schedule): void
    {
        $knownDate = Carbon::create(2021, 10, 31, 10, 50);
        Carbon::setTestNow($knownDate);
        $schedule = $this->createSchedule($schedule);
        $hasMinutesHours = new $specification['specification_class']($schedule);
        $this->assertTrue($hasMinutesHours->asQuery());

    }

    /**
     *
     * @test
     * @dataProvider schedulerSpecificationsFailTest
     * @param $specification
     * @param $schedule
     */
    public function specification_must_return_false_for_not_schedule_compatibility($specification, $schedule): void
    {
        $knownDate = Carbon::create(2021, 10, 31, 10, 50);
        Carbon::setTestNow($knownDate);
        $schedule = $this->createSchedule($schedule);
        $hasMinutesHours = new $specification['specification_class']($schedule);
        $this->assertFalse($hasMinutesHours->asQuery());

    }


    public function createSchedule(array $cronExpression): Schedule
    {
        return Schedule::create([
            ScheduleConstant::MINUTE => $cronExpression[ScheduleConstant::MINUTE],
            ScheduleConstant::HOUR => $cronExpression[ScheduleConstant::HOUR] ?: '*',
            ScheduleConstant::DAY_MONTH => $cronExpression[ScheduleConstant::DAY_MONTH] ?: '*',
            ScheduleConstant::MONTH => $cronExpression[ScheduleConstant::MONTH] ?: '*',
            ScheduleConstant::DAY_WEEK => $cronExpression[ScheduleConstant::DAY_WEEK] ?: '*',
            'report_id' => Report::create()->id
        ]);
    }
}
