<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attributes)
 */
class Transaction extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public $fillable = [
        'uuid',
        'reference',
        'purchase_amount',
        'platform_amount',
        'truncated_pan',
        'status',
        'ip',
        'device_uuid',
        'payer_uuid',
        'buyer_uuid',
        'merchant_uuid',
        'payment_method_uuid',
        'currency_uuid',
        'country_uuid',
        'created_at',
    ];

    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'reference' => $attributes['reference'],
            'purchase_amount' => $attributes['purchase_amount'],
            'platform_amount' => $attributes['platform_amount'],
            'truncated_pan' => $attributes['truncated_pan'],
            'status' => $attributes['status'],
            'ip' => $attributes['ip'],
            'device_uuid' => $attributes['device_uuid'],
            'payer_uuid' => $attributes['payer_uuid'],
            'buyer_uuid' => $attributes['buyer_uuid'],
            'merchant_uuid' => $attributes['merchant_uuid'],
            'payment_method_uuid' => $attributes['payment_method_uuid'],
            'currency_uuid' => $attributes['currency_uuid'],
            'country_uuid' => $attributes['country_uuid'],
        ]);
    }
}
