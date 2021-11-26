<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\ExportBase;

class CSV extends ExportBase
{
    public const EXT = '.csv';

    protected function getDelimiter(): string
    {
        return ',';
    }
}
