<?php

namespace App\Constants;

use App\Models\Merchant;
use App\Models\Transaction;

class ExportModels
{
    public const EXPORTABLE_MODELS = [
        Merchant::class,
        Transaction::class,
    ];
}
