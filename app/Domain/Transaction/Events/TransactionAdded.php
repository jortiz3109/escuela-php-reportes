<?php

namespace App\Domain\Transaction\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TransactionAdded extends ShouldBeStored
{
    public function __construct(public array $attributes)
    {
    }
}
