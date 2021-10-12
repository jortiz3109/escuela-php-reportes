<?php

namespace App\Aggregates;

use App\StorableEvents\MerchantCreated;
use App\StorableEvents\TransactionAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class MerchantAggregate extends AggregateRoot
{
    public function createMerchant(array $attributes): static
    {
        $this->recordThat(new MerchantCreated($attributes));

        return $this;
    }

    public function addTransaction(array $attributes):static
    {
        $this->recordThat(new TransactionAdded($attributes));

        return $this;
    }
}
