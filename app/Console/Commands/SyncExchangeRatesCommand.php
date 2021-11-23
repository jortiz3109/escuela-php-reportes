<?php

namespace App\Console\Commands;

use App\Domain\ExchangeRate\Services\ExchangeRateService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncExchangeRatesCommand extends Command
{
    protected $signature = 'exchange-rates:sync  {date? : The date to sync with format(\'Y-m-d\')}';

    protected $description = 'Reloads the current day currencies exchange rates';

    public function handle(): void
    {
        /** @var ExchangeRateService $service */
        $service = resolve(ExchangeRateService::class);

        $date = $this->argument('date');

        $this->info(Carbon::now() . ': Initializing sync currency exchanges rates');

        $exchanges = $service->sync($date);

        $this->info(Carbon::now() . ': Finalizing sync currency exchanges rates');
        $this->info(
            Carbon::now() .
            ': Exchanges rates info created: '
            . $exchanges['created']
            . ' , updated: '
            . $exchanges['updated']
            . ' with date ' . $exchanges['date']
        );
    }
}
