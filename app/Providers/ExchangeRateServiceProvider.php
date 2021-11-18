<?php

namespace App\Providers;

use App\Domain\ExchangeRate\Services\CoreApiExchangeRateService;
use App\Domain\ExchangeRate\Services\ExchangeRateServiceContract;
use Illuminate\Support\ServiceProvider;
use PlacetoPay\CoreApi\RestCoreApi;
use PlacetoPay\CoreApi\TestingCoreApi;

class ExchangeRateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ExchangeRateServiceContract::class, function () {
            return config('exchange_rates.enabled')
                ? $this->getTestingService()
                : $this->getProductionService();
        });
    }

    private function getProductionService(): ExchangeRateServiceContract
    {
        return new CoreApiExchangeRateService(new RestCoreApi([
            'login' => config('services.coreapi.login'),
            'tranKey' => config('services.coreapi.tranKey'),
        ]));
    }

    private function getTestingService(): ExchangeRateServiceContract
    {
        return new CoreApiExchangeRateService(new TestingCoreApi([
            'login' => config('services.coreapi.login'),
            'tranKey' => config('services.coreapi.tranKey'),
        ]));
    }
}
