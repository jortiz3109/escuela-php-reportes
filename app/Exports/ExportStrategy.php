<?php

namespace App\Exports;

use App\Constants\Exports;
use App\Exports\Contexts\FormatContext;
use App\Exports\Contracts\Export;
use App\Exports\Formats\CSV;
use App\Exports\Formats\CSVSemicolon;
use App\Exports\Formats\TSV;
use App\Exports\Formats\XLSX;
use App\Models\Report;

class ExportStrategy
{
    protected static array $extensions = [
        Exports::XSLX => XLSX::class,
        Exports::CSV => CSV::class,
        Exports::TSV => TSV::class,
        Exports::CSV_SEMICOLON => CSVSemicolon::class,
    ];

    public static function applyFormat(string $extension, Report $report): void
    {
        /** @var Export $extensionStrategy */
        $extensionStrategy = new self::$extensions[$extension]();

        $context = new FormatContext($extensionStrategy);

        $context->execute($report);
    }
}
