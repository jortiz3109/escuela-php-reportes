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
        Merchant::class,
        Transaction::class,
        Buyer::class,
        Payer::class,
        Currency::class,
        Country::class,
        Device::class,
        PaymentMethod::class,
    ];
}
