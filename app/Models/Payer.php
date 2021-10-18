<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 * @method static create(array $array)
 */
class Payer extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    public $fillable = [
        'uuid',
        'name',
        'email',
        'created_at',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'created_at' => $attributes['created_at'],
        ]);
    }
}
