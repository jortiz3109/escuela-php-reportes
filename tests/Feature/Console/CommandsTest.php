<?php

namespace Tests\Feature\Console;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use App\Models\Report;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function schedule_report_command_is_running(): void
    {
        $this->setATimeToTest();
        $report = Report::factory()->create();
        Schedule::factory()->count(15)->create(['report_id' => $report->id]);

        $this->artisan('reports:run')
            ->expectsOutput('All your reports schedule were run')
            ->assertExitCode(0);
    }

    /**
     * @test
     * @dataProvider cronExpression
     * @param $cronExpression
     * @param array $setTimeTest
     */
    public function a_cron_runs_at_specific_time(array $cronExpression, array $setTimeTest): void
    {

        $knownDate = Carbon::create($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], $setTimeTest['hour']);
        Carbon::setTestNow($knownDate);
        $report = Report::create();
        Report::factory()->count(10)->create();
        Schedule::factory()->create(array_merge($cronExpression ,['report_id' => $report->id]));
        $this->artisan('reports:run')
            ->expectsOutput('The report with id ' . $report->id . ' were created.')
            ->assertExitCode(0);
    }

    public function cronExpression(): array
    {
        return [
            'all days at 8 am the report will send' => [
                'cronjob' => ['minute' => '*', 'hour' => 8, 'day_month' => '*', 'month' => '*', 'day_week' => '*'],
                'setTimeTest' => ['year' => 2021, 'month' => 10, 'day_month' => 22, 'hour' => 8, 'minute' => 15]
            ],

            'At every minute on day-of-month 9 a report will be execute' => [
                'cronjob' => ['minute' => '*', 'hour' => '*', 'day_month' => 9, 'month' => '*', 'day_week' => '*'],
                'setTimeTest' => ['year' => 2021, 'month' => 10, 'day_month' => 9, 'hour' => 8, 'minute' => 15]
            ],

            'At every minute in December a report will be execute' => [
                'cronjob' => ['minute' => '*', 'hour' => '*', 'day_month' => '*', 'month' => 12, 'day_week' => '*'],
                'setTimeTest' => ['year' => 2021, 'month' => 12, 'day_month' => 9, 'hour' => 8, 'minute' => 15]
            ],

            'At every minute on day-of-month 10 a report will be execute' => [
                'cronjob' => ['minute' => '*', 'hour' => '*', 'day_month' => '*', 'month' => '*', 'day_week' => 4],
                'setTimeTest' => ['year' => 2021, 'month' => 12, 'day_month' => 9, 'hour' => 8, 'minute' => 15]
            ],
        ];
    }

}
