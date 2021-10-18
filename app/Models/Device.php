<?php

namespace App\Models;

use App\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 * @method static create(array $array)
 */
class Device extends Model
{
    use HasFactory;
    use HasUuid;

    public const UPDATED_AT = null;

    public $fillable = [
        'uuid',
        'browser',
        'os',
        'device_type',
        'created_at',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'browser' => $attributes['browser'],
            'os' => $attributes['os'],
            'device_type' => $attributes['device_type'],
            'created_at' => $attributes['created_at'],
        ]);
    }
}
