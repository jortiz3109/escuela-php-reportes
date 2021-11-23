<?php

namespace App\Providers;

use App\Domain\ExchangeRate\Services\ExchangeRateProduction;
use App\Domain\ExchangeRate\Services\ExchangeRateService;
use App\Domain\ExchangeRate\Services\ExchangeRateTesting;
use Illuminate\Support\ServiceProvider;

class ExchangeRateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ExchangeRateService::class, function () {
            return config('exchange_rates.enabled')
                ? $this->getTestingService()
                : $this->getProductionService();
        });
    }

    private function getProductionService(): ExchangeRateService
    {
        return new ExchangeRateService(new ExchangeRateProduction([
            'login' => config('services.coreapi.login'),
            'tranKey' => config('services.coreapi.tranKey'),
        ]));
    }

    private function getTestingService(): ExchangeRateService
    {
        return new ExchangeRateService(new ExchangeRateTesting());
    }
}
