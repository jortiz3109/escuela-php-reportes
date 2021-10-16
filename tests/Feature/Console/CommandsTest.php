<?php

namespace Tests\Feature\Console;

use App\Constants\Schedule as ScheduleConstants;
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

    protected function setUp(): void
    {

        parent::setUp();
    }

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
     * @dataProvider cronExpression
     * @param array $cronExpression
     * @param array $setTimeTest
     */
    public function a_command_runs_a_report_schedule_at_specific_time(array $cronExpression, array $setTimeTest): void
    {

        $knownDate = Carbon::create($setTimeTest['year'], $setTimeTest['month'], $setTimeTest['day_month'], $setTimeTest['hour']);
        Carbon::setTestNow($knownDate);
        $report = Report::create();
        Report::factory()->count(10)->create();

        Schedule::factory()->create(array_merge($cronExpression, ['report_id' => $report->id]));

        $this->artisan('reports:run')
            ->expectsOutput('The report with id ' . $report->id . ' were created.')
            ->assertExitCode(0);
    }

    public function runs_report_command_search_the_actual_date()
    {

    }

    public function cronExpression(): array
    {
        return [
            'all days at 8 am the report will send' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => '*',
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
                    ScheduleConstants::MINUTE => 15]
            ],

            'At every minute on day-of-month 9 a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => '*',
                    ScheduleConstants::HOUR => '*',
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => '*'
                ],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 10,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 15]
            ],

            'At every minute in December a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => '*',
                    ScheduleConstants::HOUR => '*',
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => 12,
                    ScheduleConstants::DAY_WEEK => '*'],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 12,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 15]
            ],

            'At every minute on day-of-month 10 a report will be execute' => [
                'cronjob' => [
                    ScheduleConstants::MINUTE => '*',
                    ScheduleConstants::HOUR => '*',
                    ScheduleConstants::DAY_MONTH => '*',
                    ScheduleConstants::MONTH => '*',
                    ScheduleConstants::DAY_WEEK => 4],
                'setTimeTest' => [
                    ScheduleConstants::YEAR => 2021,
                    ScheduleConstants::MONTH => 12,
                    ScheduleConstants::DAY_MONTH => 9,
                    ScheduleConstants::HOUR => 8,
                    ScheduleConstants::MINUTE => 15]
            ]
        ];
    }

}
