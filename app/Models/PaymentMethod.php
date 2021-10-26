<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Domain\PaymentMethod\Events\PaymentMethodCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 * @method static create(array $attributes)
 */
class PaymentMethod extends Model
{
    use HasFactory;
    use HasUuid;

    public const UPDATED_AT = null;

    public $fillable = [
        'uuid',
        'name',
        'created_at',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        event(new PaymentMethodCreated($attributes));

        return static::getByUuid($attributes['uuid']);
    }
}
