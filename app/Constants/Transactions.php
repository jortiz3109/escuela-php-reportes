<?php

namespace App\Constants;

class Transactions
{
    public const STATUS_REJECTED = 'Rejected';
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_CANCELED = 'Canceled';

    public const STATUSES = [
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
        self::STATUS_CANCELED,
    ];
}
