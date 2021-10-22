<?php

namespace App\Exports;

use App\Exports\Contexts\FormatContext;
use App\Exports\Formats\Csv;
use App\Exports\Formats\Tsv;
use App\Exports\Formats\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

class ExportStrategy
{

    static protected $formats = [
        'xlsx'=>Xls::class,
        'csv'=>Csv::class,
        'tsv'=>Tsv::class,
    ];

    public static function applyFormat(string $format, $data)
    {
        $strategy = new self::$formats[$format];
        $context = new FormatContext($strategy);

        return $context->executeStrategy($data);
    }
}
