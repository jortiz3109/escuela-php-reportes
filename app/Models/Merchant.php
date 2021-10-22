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
        'url',
        'name',
        'country_id',
        'currency_id',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'url' => $attributes['url'],
            'name' => $attributes['name'],
            'country_id' => $attributes['country_id'],
            'currency_id' => $attributes['currency_id'],
            'created_at' => $attributes['created_at'],
        ]);
    }
}
