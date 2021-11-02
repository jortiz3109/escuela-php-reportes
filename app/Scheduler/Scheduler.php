<?php

namespace App\Scheduler;

use App\Jobs\CreateReportJob;
use App\Scheduler\Specifications\CronReportShouldBeRun;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Scheduler
{
    public function builtReports(): void
    {
        $schedules = $this->scheduledDailyReport();
        foreach ($schedules as $schedule) {
            $specification = new CronReportShouldBeRun($schedule);
            if ($specification->shouldExecuteReport()) {
                CreateReportJob::dispatch($schedule);
                Log::notice('A a job for report creation were dispatched, the report id was: ' . $schedule->report_id);
            }
        }
    }

    /**
     * Avoid null pointer into the foreach.
     */
    public function scheduledDailyReport(): mixed
    {
        $schedules = Cache::get('scheduled-reports');
        if ($schedules === null) {
            Log::notice('No report where found to execute at current date ' . now()->toDateTimeString());
            return [];
        }
        return $schedules;
    }
}
