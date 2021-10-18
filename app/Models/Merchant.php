<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attributes)
 * @method static pluck(string $string)
 * @method static truncate()
 */
class Merchant extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    public $fillable = [
        'uuid',
        'name',
        'url',
        'country_uuid',
        'currency_uuid',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'name' => $attributes['name'],
            'url' => $attributes['url'],
            'country_uuid' => $attributes['country_uuid'],
            'currency_uuid' => $attributes['currency_uuid'],
            'created_at' => $attributes['created_at'],
        ]);
    }
}
