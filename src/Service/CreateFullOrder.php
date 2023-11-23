<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\OrderInput;
use App\Entity\User;
use App\Factory\OrderDetailsFactory;
use App\Factory\OrderFactory;
use App\Persister\ObjectPersister;

final readonly class CreateFullOrder
{
    public function __construct(
        private ObjectPersister $persister,
        private OrderDetailsFactory $orderDetailsFactory,
        private OrderFactory $orderFactory,
    )
    {
    }

    public function saveOrder(OrderInput $orderInput, User $user): void
    {
        $order = $this->orderFactory->create($user, $orderInput->totalPrice, $orderInput->orderDate);
        //create order detail and attach existing order to themr
    }
}