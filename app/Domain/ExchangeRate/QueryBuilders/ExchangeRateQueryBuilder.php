<?php

namespace App\Domain\ExchangeRate\QueryBuilders;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method ExchangeRate|null first($columns = ['*'])
 */
class ExchangeRateQueryBuilder extends Builder
{
    public function whereCurrency(string $currency): self
    {
        return $this->where('currency', $currency);
    }
}
