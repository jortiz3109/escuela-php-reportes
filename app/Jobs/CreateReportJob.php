<?php

namespace App\Jobs;

use App\Exports\ExportStrategy;
use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateReportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $timeout = 1800;

    public function __construct(public Report $report)
    {
    }

    public function handle(): void
    {
        ExportStrategy::applyFormat($this->report->extension, $this->report);
    }
}
