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
        'email',
        'name',
        'created_at',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'email' => $attributes['email'],
            'name' => $attributes['name'],
            'created_at' => $attributes['created_at'],
        ]);
    }
}
