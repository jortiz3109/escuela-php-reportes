<?php

namespace App\Domain\ExchangeRate\Services;

use App\Domain\ExchangeRate\Helpers\ExchangeRateHelper;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use PlacetoPay\CoreApi\Contracts\CoreApi;

class CoreApiExchangeRateService implements ExchangeRateServiceContract
{
    private CoreApi $exchangeRateProvider;

    private string $timezone = 'America/Bogota';

    public function __construct(CoreApi $exchangeRateProvider)
    {
        $this->exchangeRateProvider = $exchangeRateProvider;
    }

    public function get(string $date = null): array
    {
        return ExchangeRateHelper::toExchangeRate(
            $this->exchangeRateProvider->currencyQuotes($date),
            $date ?? Carbon::now()->timezone($this->timezone)->format('Y-m-d')
        );
    }

    public function sync(string $date = null): array
    {
        $date = $date ?? Carbon::now()->timezone($this->timezone)->format('Y-m-d');
        $exchanges = $this->get($date);
        $created = 0;
        $updated = 0;
        foreach ($exchanges as $exchange) {
            $exchange = ExchangeRate::updateOrCreate(
                [
                    'date' => $exchange->date,
                    'currency' => $exchange->currency,
                    'base' => $exchange->base,
                ],
                [
                    'rate' => $exchange->rate,
                ]
            );
            if ($exchange->wasRecentlyCreated) {
                $created += 1;
            } else {
                $updated += 1;
            }
        }

        return [
            'exchanges' => $exchanges,
            'created' => $created,
            'updated' => $updated,
            'date' => $date,
        ];
    }
}
