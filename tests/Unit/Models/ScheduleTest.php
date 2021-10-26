<?php

namespace Tests\Unit\Models;

use App\Models\Schedule;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;
    use SetCurrentDateTrait;

    /**
     * @test
     */
    public function a_schedule_can_cache_the_current_day_scheduled_reports()
    {
        $this->setDate($this);
        $schedule = Schedule::cacheHourlySchedule($this->dayMonth, $this->month, $this->dayWeek, 'scheduledHourlyReports');

        //TODO validate the test is not working into the once method call, 'cause test is invalid as it is right now
        Cache::shouldReceive('remember')
            ->with('scheduledHourlyReports', 60, \Closure::class)
            ->andReturn($schedule);
    }
}
