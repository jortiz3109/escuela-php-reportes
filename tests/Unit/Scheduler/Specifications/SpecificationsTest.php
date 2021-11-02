<?php

namespace Tests\Unit\Scheduler\Specifications;

use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\HasSchedulerProviders;
use Tests\Helpers\SchedulerHelper;
use Tests\TestCase;

class SpecificationsTest extends TestCase
{
    use SchedulerHelper;
    use RefreshDatabase;
    use SetCurrentDateTrait;
    use HasSchedulerProviders;

    /**
     * @test
     * @dataProvider schedulerSpecificationsSuccessTest
     * @param $specification
     * @param $schedule
     */
    public function specification_must_return_true_for_schedule_compatibility($specification, $schedule): void
    {
        $this->setCurrentTime(2021, 10, 31, 10, 50);

        $schedule = $this->createSchedule($schedule);
        $hasMinutesHours = new $specification['specification_class']($schedule);
        $this->assertTrue($hasMinutesHours->shouldExecuteReport());
    }

    /**
     * @test
     * @dataProvider schedulerSpecificationsFailTest
     * @param $specification
     * @param $schedule
     */
    public function specification_must_return_false_for_not_schedule_compatibility($specification, $schedule): void
    {
        $this->setCurrentTime(2021, 10, 31, 10, 50);
        $schedule = $this->createSchedule($schedule);
        $reportShouldBeRun = new $specification['specification_class']($schedule);
        $this->assertFalse($reportShouldBeRun->shouldExecuteReport());
    }
}
