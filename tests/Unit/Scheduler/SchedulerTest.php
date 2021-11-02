<?php

namespace Tests\Unit\Scheduler;

use App\Scheduler\Scheduler;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\Helpers\SchedulerHelper;
use Tests\TestCase;

class SchedulerTest extends TestCase
{
    use RefreshDatabase;
    use SetCurrentDateTrait;
    use SchedulerHelper;

    protected Model $report;

    /**
     * @test
     */
    public function it_should_run_the_specific_scheduled_reports(): void
    {
        $this->createTestScenario();
        $this->setCurrentTime(2021, 3, 4, 15, 22);

        Log::shouldReceive('notice')
            ->atLeast()
            ->once()
            ->with('A a job for report creation were dispatched, the report id was: ' . $this->report->id);

        $scheduler = new Scheduler();
        $scheduler->builtReports();
    }

    /**
     * @test
     */
    public function it_should_log_a_message_if_reports_scheduled_does_not_exists(): void
    {
        Log::shouldReceive('notice')
            ->atLeast()
            ->once()
            ->with('No report where found to execute at current date ' . now()->toDateTimeString());

        $scheduler = new Scheduler();
        $scheduler->builtReports();
    }
}
