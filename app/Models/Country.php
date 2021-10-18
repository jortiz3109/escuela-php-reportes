<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Domain\Country\Events\CountryCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 * @method static create($attributes)
 */
class Country extends Model
{
    use HasFactory;
    use HasUuid;

    public $timestamps = false;

    public $fillable = [
        'uuid',
        'numeric_code',
        'alpha_3_code',
        'created_at',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        event(new CountryCreated($attributes));

        return static::uuid($attributes['uuid']);
    }
}
