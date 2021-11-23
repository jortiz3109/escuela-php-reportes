<?php

namespace App\Domain\ExchangeRate\Services;

use App\Domain\ExchangeRate\Contracts\ExchangeRateContract;
use App\Domain\ExchangeRate\Helpers\ExchangeRateHelper;
use App\Models\ExchangeRate;
use Carbon\Carbon;

class ExchangeRateService
{
    private ExchangeRateContract $exchangeRateProvider;

    private string $timezone = 'America/Bogota';

    public function __construct(ExchangeRateContract $exchangeRateProvider)
    {
        $this->exchangeRateProvider = $exchangeRateProvider;
    }

    /**
     * @return ExchangeRate[]
     */
    public function get(string $date = null): array
    {
        return ExchangeRateHelper::getExchangeRates(
            $this->exchangeRateProvider->getCurrencyQuotes($date),
            $date ?? Carbon::now()->timezone($this->timezone)->format('Y-m-d')
        );
    }

    public function sync(string $date = null): void
    {
        $date ??= Carbon::now()->timezone($this->timezone)->format('Y-m-d');

        $exchanges = $this->get($date);

        foreach ($exchanges as $exchange) {
            ExchangeRate::query()->updateOrCreate(
                [
                    'date' => $exchange->date,
                    'currency' => $exchange->currency,
                    'base' => $exchange->base,
                ],
                [
                    'rate' => $exchange->rate,
                ]
            );
        }
    }
}
