<?php

namespace App\Domain\ExchangeRate\Helpers;

use App\Domain\ExchangeRate\CurrencyQuote;
use App\Models\Currency;
use App\Models\ExchangeRate;

class ExchangeRateHelper
{
    /**
     * @param CurrencyQuote[] $currencyQuotes
     * @return ExchangeRate[]
     */
    public static function getExchangeRates(array $currencyQuotes, string $date): array
    {
        $exchangeRates = [];

        foreach ($currencyQuotes as $currencyQuote) {
            $exchangeRates[] = new ExchangeRate([
                'base' => 'USD',
                'currency' => $currencyQuote->currency(),
                'rate' => $currencyQuote->factor(),
                'date' => $date,
            ]);
        }

        return $exchangeRates;
    }

    public static function convertToPlatformCurrency(Currency $currency, string $amount): string
    {
        $currencyUSD = Currency::query()->whereAlphabeticCode('USD')->first();

        $exchange = ExchangeRate::query()->whereCurrency($currency->alphabetic_code)
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
