<?php

namespace App\Models;

use App\Domain\ExchangeRate\QueryBuilders\ExchangeRateQueryBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static ExchangeRateQueryBuilder query()
 * @property string $date
 * @property string $base
 * @property string $currency
 * @property float $rate
 */
class ExchangeRate extends Model
{
    protected $fillable = [
        'date',
        'base',
        'currency',
        'rate',
    ];

    protected $dates = [
        'date',
    ];

    public function newEloquentBuilder($query): ExchangeRateQueryBuilder
    {
        return new ExchangeRateQueryBuilder($query);
    }
}
