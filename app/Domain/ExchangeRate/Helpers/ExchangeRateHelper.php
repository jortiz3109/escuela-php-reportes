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

    public static function convertToPlatformCurrency(array $attributes): string
    {
        /** @var Currency $currency */
        $currency = Currency::query()->findOrFail($attributes['currency_id']);

        $currencyUSD = Currency::query()->whereAlphabeticCode('USD')->first();

        $exchange = ExchangeRate::query()->whereCurrency($currency->alphabetic_code)
            ->orderBy('date', 'desc')
            ->first(['id', 'rate']);

        return (string)($exchange ?
            self::convert($attributes['purchase_amount'], $exchange, $currencyUSD) :
            $attributes['purchase_amount']);
    }

    protected static function convert(string $purchase_amount, ExchangeRate $exchange, ?Currency $currencyUSD): float
    {
        return round((float)$purchase_amount / $exchange->rate, 2) * pow(10, $currencyUSD->minor_unit);
    }
}
