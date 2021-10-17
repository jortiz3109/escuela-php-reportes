<?php

namespace App\Aggregates;

use App\Models\Transaction;
use App\StorableEvents\MerchantCreated;
use App\StorableEvents\TransactionAdded;
use Ramsey\Uuid\Uuid;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class MerchantAggregate extends AggregateRoot
{
    public function createMerchant(array $attributes): static
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        $this->recordThat(new MerchantCreated($attributes));

        return $this;
    }

    public function addTransaction(array $attributes): static
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        $this->recordThat(new TransactionAdded($attributes));

        return $this;
    }
}
