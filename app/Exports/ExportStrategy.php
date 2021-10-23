<?php

namespace App\Exports;

use App\Exports\Contexts\FormatContext;
use App\Exports\Contracts\FormatContract;
use App\Exports\Formats\CSV;
use App\Exports\Formats\TSV;
use App\Exports\Formats\XLSX;
use Illuminate\Database\Eloquent\Builder;

class ExportStrategy
{
    protected static array $extensions = [
        'xlsx' => XLSX::class,
        'csv' => CSV::class,
        'tsv' => TSV::class,
    ];

    public static function applyFormat(string $extension, Builder $builder): void
    {
        /** @var FormatContract $extensionStrategy */
        $extensionStrategy = new self::$extensions[$extension]();

        $context = new FormatContext($extensionStrategy);

        $context->execute($builder);
    }
}
