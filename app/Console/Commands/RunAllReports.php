<?php

namespace App\Console\Commands;

use App\Models\Schedule;
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
    private Schedule $schedule;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = [
            'minute' => CarbonImmutable::now()->format('i'),
            'hour' => CarbonImmutable::now()->isoFormat('H'),
            'day_month' => CarbonImmutable::now()->isoFormat('D'),
            'month' => CarbonImmutable::now()->isoFormat('M'),
            'day_week' => CarbonImmutable::now()->weekday()
        ];
        $tasks = $this->schedule->reportsToSchedule($query);
        foreach ( $tasks->get() as $task){
            $this->line('The report with id '.$task->report_id.' were created.');
        }
        $this->line('All your reports schedule were ran.');
    }
}
