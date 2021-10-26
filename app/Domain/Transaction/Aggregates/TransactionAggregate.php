<?php

namespace App\Domain\Transaction\Aggregates;

use App\Domain\Transaction\Events\TransactionAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class TransactionAggregate extends AggregateRoot
{
    public function addTransaction(string $uuid, array $attributes): static
    {
        $attributes['uuid'] = $uuid;

        $this->recordThat(new TransactionAdded($attributes));

        return $this;
    }
}
