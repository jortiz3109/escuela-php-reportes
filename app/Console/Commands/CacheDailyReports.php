<?php

namespace App\Console\Commands;

use App\Constants\Commands;
use App\Models\Schedule;
use App\Scheduler\Traits\SetCurrentDateTrait;
use Illuminate\Console\Command;

class CacheDailyReports extends Command
{
    use SetCurrentDateTrait;

    protected $signature = Commands::CACHE_REPORTS_CALL;

    protected $description = 'Get all the daily scheduled reports and set it into cache';

    public const CACHE_REPORTS_DAiLY_KEY = 'scheduled-reports';

    public function handle(): int
    {
        $this->setDate();
        Schedule::cacheDailyScheduledReports($this->dayMonth, $this->month, $this->dayWeek, self::CACHE_REPORTS_DAiLY_KEY);
        $this->line('Reports were get into the cache, with key = ' . self::CACHE_REPORTS_DAiLY_KEY);
        return Command::SUCCESS;
    }
}
