<?php

namespace App\Domain\Currency\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CurrencyCreated extends ShouldBeStored
{
    public function __construct(public array $attributes)
    {
    }
}
