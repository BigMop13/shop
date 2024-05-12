<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\PlaceOrder;
use App\Service\CreateFullOrder;

final readonly class PlaceOrderHandler
{
    public function __construct(private CreateFullOrder $createFullOrder)
    {
    }

    public function __invoke(PlaceOrder $placeOrderMessage): void
    {
        $this->createFullOrder->saveOrder($placeOrderMessage->orderInput, $placeOrderMessage->user);
    }
}
