<?php

namespace App\Domain\ExchangeRate;

class CurrencyQuote
{
    public function __construct(public string $currency, public string $factor)
    {
    }

    public function currency(): string
    {
        return $this->currency;
    }
    public function factor(): string
    {
        return $this->factor;
    }
}
