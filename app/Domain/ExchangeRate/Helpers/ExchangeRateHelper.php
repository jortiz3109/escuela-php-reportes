<?php

namespace App\Domain\ExchangeRate\Helpers;

use App\Domain\ExchangeRate\Exceptions\CurrencyNotFoundException;
use App\Models\Currency;
use App\Models\ExchangeRate;

class ExchangeRateHelper
{
    public static function toExchangeRate(array $response, string $date): array
    {
        $exchanges = [];

        foreach ($response as $value) {
            array_push(
                $exchanges,
                new ExchangeRate([
                    'base' => 'USD',
                    'currency' => $value->currency(),
                    'rate' => $value->factor(),
                    'date' => $date,
                ])
            );
        }

        return $exchanges;
    }

    /**
     * @throws CurrencyNotFoundException
     */
    public static function convertToPlatformCurrency(?Currency $currency, string $amount): string
    {
        /** @var Currency $currencyUSD */
        $currencyUSD = Currency::query()->firstWhere('alphabetic_code', 'USD');

        if (!$currency) {
            throw new CurrencyNotFoundException('Currency ' . $currency . ' not found');
        }

        $exchange = ExchangeRate::query()->where('currency', $currency->alphabetic_code)
            ->orderBy('date', 'desc')
            ->first(['id', 'rate']);

        return (string)($exchange ?
            round((float)$amount / $exchange->rate, 2) * pow(10, $currencyUSD->minor_unit) :
            $amount);
    }

    public static function convert(int $amount, int $currencyMinorUnit, float $rate): float
    {
        return $amount / pow(10, $currencyMinorUnit) * $rate;
    }
}
