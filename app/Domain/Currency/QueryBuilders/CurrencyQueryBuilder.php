<?php

namespace App\Domain\Currency\QueryBuilders;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method Currency|null first($columns = ['*'])
 */
class CurrencyQueryBuilder extends Builder
{
    public function whereAlphabeticCode(string $alphabeticCode): self
    {
        return $this->where('alphabetic_code', $alphabeticCode);
    }
}
