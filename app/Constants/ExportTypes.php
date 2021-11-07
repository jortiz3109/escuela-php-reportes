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

class ExportTypes
{
    public const GENERAL_REPORT = 'general';

    public const EXPORTABLE_TABLES = [
        'merchants',
        'transactions',
        'buyers',
        'payers',
        'currencies',
        'countries',
        'devices',
        'payment_methods',
    ];

    public const EXPORTABLE_TYPES = [
        self::GENERAL_REPORT,
    ];
}
