<?php

namespace App\Domain\ExchangeRate\Contracts;

use App\Domain\ExchangeRate\CurrencyQuote;

interface ExchangeRateContract
{
    /**
     * Gets the quotes (USD based factor) for the currencies supported on PlacetoPay.
     * @return CurrencyQuote[]
     */
    public function getCurrencyQuotes(string $date = null): array;
}
