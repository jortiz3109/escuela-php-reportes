<?php

namespace App\Domain\ExchangeRate\Services;

interface ExchangeRateServiceContract
{
    public function get(string $date = null): array;

    public function sync(string $date = null): array;
}
