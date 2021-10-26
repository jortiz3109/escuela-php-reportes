<?php

namespace App\Domain\Merchant\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class MerchantCreated extends ShouldBeStored
{
    public function __construct(public array $attributes)
    {
    }
}
