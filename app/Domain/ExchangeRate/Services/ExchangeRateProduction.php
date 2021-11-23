<?php

namespace App\Domain\ExchangeRate\Services;

use App\Domain\ExchangeRate\Contracts\ExchangeRateContract;

class ExchangeRateProduction implements ExchangeRateContract
{
    public function __construct(public array $credentials)
    {
    }

    public function getCurrencyQuotes(string $date = null): array
    {
        // TODO: Implement getCurrencyQuotes() method.
    }
}
