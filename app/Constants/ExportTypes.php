<?php

namespace App\Constants;

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
