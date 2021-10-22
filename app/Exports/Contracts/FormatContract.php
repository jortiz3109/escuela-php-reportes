<?php

namespace App\Exports\Contracts;

interface FormatContract
{
    public function export($data): bool;
}
