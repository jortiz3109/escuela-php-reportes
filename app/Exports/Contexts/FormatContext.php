<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\FormatContract;

class FormatContext
{
    private $strategy;

    public function __construct(FormatContract $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy($data)
    {
        return $this->strategy->format($data);
    }

}
