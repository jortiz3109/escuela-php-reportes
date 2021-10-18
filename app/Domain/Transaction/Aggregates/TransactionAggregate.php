<?php

namespace App\Domain\Transaction\Aggregates;

use App\Domain\Transaction\Events\TransactionAdded;
use Ramsey\Uuid\Uuid;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class TransactionAggregate extends AggregateRoot
{
    public function addTransaction(array $attributes): static
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        $this->recordThat(new TransactionAdded($attributes));

        return $this;
    }
}
