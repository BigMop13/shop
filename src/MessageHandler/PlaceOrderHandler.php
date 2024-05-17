<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\PlaceOrderEvent;
use App\Service\CreateFullOrder;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class PlaceOrderHandler
{
    public function __construct(private CreateFullOrder $createFullOrder)
    {
    }

    public function __invoke(PlaceOrderEvent $placeOrderMessage): void
    {
        $this->createFullOrder->saveOrder($placeOrderMessage->orderInput, $placeOrderMessage->user);
    }
}
