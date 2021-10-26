<?php

namespace App\Domain\PaymentMethod\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class PaymentMethodCreated extends ShouldBeStored
{
    public function __construct(public array $attributes)
    {
    }
}
