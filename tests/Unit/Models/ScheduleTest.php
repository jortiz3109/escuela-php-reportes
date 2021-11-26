<?php

namespace Tests\Unit\Models;

use App\Models\Schedule;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\Helpers\SchedulerHelper;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use SchedulerHelper;
    use SetCurrentDateTrait;

    /**
     * @test
     */
    public function a_schedule_can_cache_the_current_day_scheduled_reports(): void
    {
        $this->createTestScenario();
        $this->assertDatabaseHas('schedules', $this->schedule->attributesToArray())
            ->assertDatabaseCount('schedules', 1);

        $this->setDate();
        Schedule::cacheDailyScheduledReports($this->dayMonth, $this->month, $this->dayWeek, 'scheduled-reports');

        Cache::shouldReceive('get')
            ->once()
            ->with('scheduled-reports')
            ->andReturn($this->schedule);

        $this->assertNotNull(Cache::get('scheduled-reports'));
    }

    /**
     * @test
     */
    public function a_schedule_will_not_cache_if_there_are_not_schedules_values_into_the_table(): void
    {
        $this->assertDatabaseCount('schedules', 0);

        $this->setDate();
        Schedule::cacheDailyScheduledReports($this->dayMonth, $this->month, $this->dayWeek, 'scheduled-reports');

        Cache::shouldReceive('get')
            ->once()
            ->with('scheduled-reports')
            ->andReturnNull();

        $this->assertNull(Cache::get('scheduled-reports'));
    }
}
