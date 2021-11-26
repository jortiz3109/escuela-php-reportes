<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\ExportBase;

class TSV extends ExportBase
{
    public const EXT = '.tsv';

    protected function getDelimiter(): string
    {
        return chr(9);
    }
}
