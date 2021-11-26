<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
     * @var array
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('reports:run')
           ->everyMinute()
           ->withoutOverlapping();

        $schedule->command('cache-reports:run')
            ->cron('0 0 * * *');
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
