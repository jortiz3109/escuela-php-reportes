<?php

namespace Tests\Feature\Console\Commands;

use App\Constants\Commands;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\Helpers\SchedulerHelper;
use Tests\TestCase;

class CacheDailyReportsTest extends TestCase
{
    use RefreshDatabase;
    use SchedulerHelper;
    use SetCurrentDateTrait;

    protected Model $schedule;
    /**
     * @test
     */
    public function it_should_return_a_line(): void
    {
        $this->artisan(Commands::CACHE_REPORTS_CALL)
            ->expectsOutput('Reports were get into the cache, with key = ' . 'scheduled-reports')
            ->assertExitCode(0);
    }

    /**
     * @test
     */
    public function it_should_create_a_cache_register_for_schedule(): void
    {
        $this->createTestScenario();
        $this->artisan(Commands::CACHE_REPORTS_CALL);

        Cache::shouldReceive('get')
            ->once()
            ->with('scheduled-reports')
            ->andReturn($this->schedule);

        $this->assertNotNull(Cache::get('scheduled-reports'));
    }

    /**
     * @test
     */
    public function it_should_not_create_a_cache_register_for_schedule_if_there_are_not_coincidences(): void
    {
        $this->artisan(Commands::CACHE_REPORTS_CALL);

        Cache::shouldReceive('get')
            ->once()
            ->with('scheduled-reports')
            ->andReturnNull();

        $this->assertNull(Cache::get('scheduled-reports'));
    }
}
