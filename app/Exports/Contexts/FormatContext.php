<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\FormatContract;

class FormatContext
{
    private FormatContract $strategy;

    public function __construct(FormatContract $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy($data): bool
    {
        return $this->strategy->export($data);
    }

}
