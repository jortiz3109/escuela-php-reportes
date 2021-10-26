<?php

namespace Tests\Feature\Console;

use App\Events\CreateScheduledReport;
use App\Models\Report;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Tests\Concerns\HasSchedulerProviders;
use Tests\TestCase;

class CommandsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use HasSchedulerProviders;

    /**
     * @test
     */
    public function schedule_report_command_is_running(): void
    {
        $this->artisan('reports:run')
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
        Event::fake();
        $knownDate = Carbon::create($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], $setTimeTest['hour'], $setTimeTest['minute']);
        Carbon::setTestNow($knownDate);
        $report = Report::create();
        Report::factory()->count(10)->create();
        Schedule::factory()->count(10)->create();
        Schedule::factory()->create(array_merge($cronExpression, ['report_id' => $report->id]));

        $this->artisan('reports:run')
            ->assertExitCode(0);
        $this->expectOutputString('A report with id ' . $report->id . ' was created');

        Event::assertDispatched(CreateScheduledReport::class);
    }

    /**
     * @test
     * @dataProvider nonScheduledCronExpression
     * @param array $cronExpression
     * @param array $setTimeTest
     */
    public function a_command_will_no_run_reports_that_were_not_scheduled(array $cronExpression, array $setTimeTest): void
    {
        Event::fake();
        $knownDate = Carbon::create($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], $setTimeTest['hour'], $setTimeTest['minute']);
        Carbon::setTestNow($knownDate);
        $report = Report::create();
        Report::factory()->count(10)->create();
        Schedule::factory()->count(10)->create();
        Schedule::factory()->create(array_merge($cronExpression, ['report_id' => $report->id]));

        $this->artisan('reports:run')
            ->assertExitCode(0);

        Event::assertNotDispatched(CreateScheduledReport::class);
    }
}
