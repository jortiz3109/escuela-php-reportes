<?php

namespace App\Constants;

use App\Models\Buyer;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Device;
use App\Models\Merchant;
use App\Models\Payer;
use App\Models\PaymentMethod;
use App\Models\Transaction;

class ExportModels
{
    public const EXPORTABLE_MODELS = [
        'merchants' => Merchant::class,
        'transactions' => Transaction::class,
        'buyers' => Buyer::class,
        'payers' => Payer::class,
        'currencies' => Currency::class,
        'countries' => Country::class,
        'devices' => Device::class,
        'payment_methods' => PaymentMethod::class,
    ];
}
