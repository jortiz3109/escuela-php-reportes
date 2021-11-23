<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Domain\ExchangeRate\Exceptions\CurrencyNotFoundException;
use App\Domain\ExchangeRate\Helpers\ExchangeRateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attributes)
 */
class Transaction extends Model
{
    use HasFactory;
    use HasUuid;

    public const UPDATED_AT = null;

    public $fillable = [
        'uuid',
        'reference',
        'platform_amount',
        'purchase_amount',
        'truncated_pan',
        'ip',
        'status',
        'device_id',
        'payer_id',
        'buyer_id',
        'merchant_id',
        'payment_method_id',
        'currency_id',
        'country_id',
        'created_at',
    ];

    /**
     * @throws CurrencyNotFoundException
     */
    public static function createWithAttributes(array $attributes): self
    {
        return static::create([
            'uuid' => $attributes['uuid'],
            'reference' => $attributes['reference'],
            'purchase_amount' => $attributes['purchase_amount'],
            'platform_amount' => $attributes['platform_amount'] ?? static::setPlatformAmountFromMessage($attributes),
            'truncated_pan' => $attributes['truncated_pan'],
            'status' => $attributes['status'],
            'ip' => $attributes['ip'],
            'device_id' => $attributes['device_id'],
            'payer_id' => $attributes['payer_id'],
            'buyer_id' => $attributes['buyer_id'],
            'merchant_id' => $attributes['merchant_id'],
            'payment_method_id' => $attributes['payment_method_id'],
            'currency_id' => $attributes['currency_id'],
            'country_id' => $attributes['country_id'],
            'created_at' => $attributes['created_at'],
        ]);
    }

    private static function setPlatformAmountFromMessage(array $attributes): string
    {
        /** @var Currency $currency */
        $currency = Currency::query()->findOrFail($attributes['currency_id']);

        return ExchangeRateHelper::convertToPlatformCurrency($currency, $attributes['purchase_amount']);
    }
}
