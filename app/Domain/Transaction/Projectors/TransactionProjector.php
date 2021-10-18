<?php

namespace App\Domain\Transaction\Projectors;

use App\Domain\Transaction\Events\TransactionAdded;
use App\Models\Transaction;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class TransactionProjector extends Projector
{
    public function onTransactionAdded(TransactionAdded $event)
    {
        Transaction::createWithAttributes(array_merge($event->attributes, ['created_at' => $event->attributes['created_at']]));
    }
}
