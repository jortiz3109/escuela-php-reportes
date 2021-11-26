<?php

namespace App\Console\Commands;

use App\Constants\Commands;
use App\Scheduler\Scheduler;
use Illuminate\Console\Command;

class RunAllReports extends Command
{
    protected $signature = Commands::RUN_ALL_REPORTS_CALL;

    protected $description = 'Generate all the scheduled reports';

    private Scheduler $scheduler;

    public function __construct(Scheduler $schedule)
    {
        $this->scheduler = $schedule;
        parent::__construct();
    }

    public function handle(): int
    {
        $this->scheduler->builtReports();
        $this->line('All your reports schedule were ran.');

        return Command::SUCCESS;
    }
}
