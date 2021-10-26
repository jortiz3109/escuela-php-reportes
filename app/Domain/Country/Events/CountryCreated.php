<?php

namespace App\Domain\Country\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CountryCreated extends ShouldBeStored
{
    public function __construct(public array $attributes)
    {
    }
}
