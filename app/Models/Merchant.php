<?php

namespace App\Models;

use App\StorableEvents\MerchantCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @method static create(array $attributes)
 */
class Merchant extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public static function createWithAttributes(array $attributes): Merchant
    {
        /*
         * Let's generate a uuid.
         */
        $attributes['uuid'] = (string) Uuid::uuid4();

        /*
         * The account will be created inside this event using the generated uuid.
         */
        event(new MerchantCreated($attributes));

        /*
         * The uuid will be used the retrieve the created account.
         */
        return static::uuid($attributes['uuid']);
    }
}
