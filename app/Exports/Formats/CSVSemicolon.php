<?php

namespace App\Exports\Formats;

class CSVSemicolon extends \App\Exports\Contracts\ExportBase
{
    public const EXT = '.csv';

    protected function getDelimiter(): string
    {
        return ';';
    }
}
