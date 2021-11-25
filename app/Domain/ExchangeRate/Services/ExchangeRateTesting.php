<?php

namespace App\Domain\ExchangeRate\Services;

use App\Domain\ExchangeRate\Contracts\ExchangeRateContract;
use App\Domain\ExchangeRate\CurrencyQuote;

class ExchangeRateTesting implements ExchangeRateContract
{
    /**
     * @return CurrencyQuote[]
     */
    public function getCurrencyQuotes(string $date = null): array
    {
        $data = [
            'COP' => 2930.78,
            'USD' => 1,
            'EUR' => 0.90596122485958,
            'CAD' => 1.3245153107447,
            'AUD' => 1.3230657727849,
            'GBP' => 0.81926073564051,
            'JPY' => 103.72350063417,
            'MXN' => 18.982786736728,
            'CRC' => 547.15,
            'PEN' => 3.4005,
            'CLP' => 671.23,
            'ARS' => 15.055,
            'UYU' => 28.05,
        ];

        $quotes = [];

        foreach ($data as $currency => $factor) {
            $quotes[] = new CurrencyQuote($currency, $factor);
        }

        return $quotes;
    }
}
