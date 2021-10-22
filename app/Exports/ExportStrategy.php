<?php

namespace App\Exports;

use App\Exports\Contexts\FormatContext;
use App\Exports\Contracts\FormatContract;
use App\Exports\Formats\CSV;
use App\Exports\Formats\TSV;
use App\Exports\Formats\XLSX;

class ExportStrategy
{
    protected static array $extensions = [
        'xlsx' => XLSX::class,
        'csv' => CSV::class,
        'tsv' => TSV::class,
    ];

    public static function applyFormat(string $extension, $data): bool
    {
        /** @var FormatContract $extensionStrategy */
        $extensionStrategy = new self::$extensions[$extension]();

        $context = new FormatContext($extensionStrategy);

        return $context->executeStrategy($data);
    }
}
