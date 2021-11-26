<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatBase;

class TSV extends FormatBase
{
    public const EXT = '.tsv';

    protected function getDelimiter(): string
    {
        return chr(9);
    }
}
