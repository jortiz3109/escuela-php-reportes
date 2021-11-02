<?php

namespace Tests\Feature\Console\Commands;

use App\Constants\Commands;
use App\Jobs\CreateReportJob;
use App\Models\Report;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Tests\Concerns\HasSchedulerProviders;
use Tests\Helpers\SchedulerHelper;
use Tests\TestCase;

class RunAllReportsTest extends TestCase
{
    use WithFaker;
    use SchedulerHelper;
    use RefreshDatabase;
    use HasSchedulerProviders;

    /**
     * @test
     */
    public function schedule_report_command_is_running(): void
    {
        $this->artisan(Commands::RUN_ALL_REPORTS_CALL)
            ->expectsOutput('All your reports schedule were ran.')
            ->assertExitCode(0);
    }

    /**
     * @test
     * @dataProvider scheduledCronExpression
     * @param array $cronExpression
     * @param array $setTimeTest
     */
    public function a_command_runs_a_report_schedule_at_specific_time(array $cronExpression, array $setTimeTest): void
    {
        Bus::fake();
        $this->withoutExceptionHandling();
        $report = $this->createReportsAndSchedule($cronExpression);
        $this->getCacheReports($setTimeTest);

        $this->setCurrentTime($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], $setTimeTest['hour'], $setTimeTest['minute']);

        Log::shouldReceive('notice')
            ->once()
            ->with('A a job for report creation were dispatched, the report id was: ' . $report->id);

        $this->artisan(Commands::RUN_ALL_REPORTS_CALL)
            ->assertExitCode(0);

        Bus::assertDispatched(CreateReportJob::class);
    }

    /**
     * @test
     * @dataProvider nonScheduledCronExpression
     * @param array $cronExpression
     * @param array $setTimeTest
     */
    public function a_command_will_no_run_reports_that_were_not_scheduled(array $cronExpression, array $setTimeTest): void
    {
        Bus::fake();
        $this->getCacheReports($setTimeTest);
        $this->createReportsAndSchedule($cronExpression);

        $this->setCurrentTime($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], $setTimeTest['hour'], $setTimeTest['minute']);

        $this->artisan(Commands::RUN_ALL_REPORTS_CALL)
            ->assertExitCode(0);

        Bus::assertNotDispatched(CreateReportJob::class);
    }

    public function getCacheReports(array $setTimeTest): void
    {
        $knownDate = Carbon::create($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], 00, 00);
        Carbon::setTestNow($knownDate);
        $this->artisan(Commands::CACHE_REPORTS_CALL);
    }

    public function createReportsAndSchedule(array $cronExpression): Model
    {
        $report = Report::factory()->create();
        Report::factory()->count(10)->create();
        Schedule::factory()->count(10)->create();
        Schedule::factory()->create(array_merge($cronExpression, ['report_id' => $report->id]));

        return $report;
    }
}
