<?php

namespace App\Constants;

class Exports
{
    public const CSV = 'csv';
    public const XSLX = 'xslx';
    public const TSV = 'tsv';

    public const SENDER_EMAIL = 'email';
    public const SENDER_SFTP = 'sftp';

    public const SENDERS = [
        self::SENDER_EMAIL,
        self::SENDER_SFTP,
    ];

    public const TYPES = [
        self::XSLX,
        self::CSV,
        self::TSV,
    ];
}
