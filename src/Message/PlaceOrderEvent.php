<?php

declare(strict_types=1);

namespace App\Message;

use App\Dto\OrderInput;
use Symfony\Component\Security\Core\User\UserInterface;

final readonly class PlaceOrderEvent
{
    public function __construct(
        public OrderInput $orderInput,
        public ?UserInterface $user = null,
    ) {
    }
}
