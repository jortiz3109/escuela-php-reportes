<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatBase;

class CSV extends FormatBase
{
    public const EXT = '.csv';

    protected function getDelimiter(): string
    {
        return ',';
    }
}
