<?php

namespace Tests\Unit\Models;

use App\Models\Schedule;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use SetCurrentDateTrait;

    /**
     * @test
     */
    public function a_schedule_can_cache_the_current_day_scheduled_reports(): void
    {
        $this->setDate();
        Schedule::cacheDailyScheduledReports($this->dayMonth, $this->month, $this->dayWeek, 'scheduled-reports');

        $this->assertNotNull(Cache::get('scheduled-reports'));
    }

    /**
     * @test
     */
    public function a_schedule_will_not_cache_other_key(): void
    {
        $this->setDate();
        Schedule::cacheDailyScheduledReports($this->dayMonth, $this->month, $this->dayWeek, 'scheduled-reports');

        $resultKey = $this->faker->randomElement(['report', 'Schedule', 'schedule', 'scheduledHourlyReport']);
        $this->assertNull(Cache::get($resultKey));
    }
}
