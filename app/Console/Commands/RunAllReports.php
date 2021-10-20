<?php

namespace App\Console\Commands;

use App\Constants\Schedule as ScheduleConstants;
use App\Models\Schedule;
use App\Scheduler\Scheduler;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class RunAllReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all the reports ';
    private Scheduler $scheduler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Scheduler $schedule)
    {
        $this->scheduler = $schedule;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scheduler->builtReports();
        $this->line('All your reports schedule were ran.');
    }
}
