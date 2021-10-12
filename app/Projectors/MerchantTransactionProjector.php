<?php

namespace App\Projectors;

use App\Models\Merchant;
use App\Models\Transaction;
use App\StorableEvents\MerchantCreated;
use App\StorableEvents\TransactionAdded;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class MerchantTransactionProjector extends Projector
{
    public function onMerchantCreated(MerchantCreated $event)
    {
        Merchant::create($event->attributes);
    }

    public function onTransactionAdded(TransactionAdded $event)
    {
        Transaction::create($event->attributes);
    }
}
