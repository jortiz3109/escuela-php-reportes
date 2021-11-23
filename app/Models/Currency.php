<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Domain\Currency\Events\CurrencyCreated;
use App\Domain\Currency\QueryBuilders\CurrencyQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Currency create(array $attributes)
 * @method static CurrencyQueryBuilder query()
 * @property string $alphabetic_code
 * @property string $minor_unit
 */
class Currency extends Model
{
    use HasFactory;
    use HasUuid;

    public $timestamps = false;

    public $fillable = [
        'uuid',
        'alphabetic_code',
        'numeric_code',
        'minor_unit',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        event(new CurrencyCreated($attributes));

        return static::getByUuid($attributes['uuid']);
    }

    public function newEloquentBuilder($query): CurrencyQueryBuilder
    {
        return new CurrencyQueryBuilder($query);
    }
}
