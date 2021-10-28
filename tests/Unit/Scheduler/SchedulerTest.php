<?php

namespace Tests\Unit\Scheduler;

use App\Constants\Schedule as ScheduleConstant;
use App\Models\Report;
use App\Models\Schedule;
use App\Scheduler\Scheduler;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchedulerTest extends TestCase
{
    use RefreshDatabase;
    use SetCurrentDateTrait;

    protected Report $report;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setDate($this);
        $this->report = Report::create();
        Schedule::factory()
            ->create([
                ScheduleConstant::MINUTE => $this->minute,
                ScheduleConstant::HOUR => $this->hour,
                ScheduleConstant::DAY_MONTH => $this->dayMonth,
                ScheduleConstant::MONTH => $this->month,
                ScheduleConstant::DAY_WEEK => $this->dayWeek,
                'report_id' => $this->report->id,
            ]);
    }

    /**
     * @test
     */
    public function it_should_run_the_specific_scheduled_reports(): void
    {
        $scheduler = new Scheduler();
        $scheduler->builtReports();
        $this->expectOutputString('A report with id ' . $this->report->id . ' was created');
    }
}
