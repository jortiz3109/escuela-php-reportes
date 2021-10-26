<?php

namespace App\Domain\Merchant\Aggregates;

use App\Domain\Merchant\Events\MerchantCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class MerchantAggregate extends AggregateRoot
{
    public function createMerchant(string $uuid, array $attributes): static
    {
        $attributes['uuid'] = $uuid;

        $this->recordThat(new MerchantCreated($attributes));

        return $this;
    }
}
