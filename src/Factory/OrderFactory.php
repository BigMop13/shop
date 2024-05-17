<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dictionary\OrderStatuses;
use App\Entity\Client;
use App\Entity\Order;
use App\Entity\User;

final class OrderFactory
{
    public function create(Client $client, ?User $user, int $totalPrice, \DateTimeImmutable $orderDate, string $status = OrderStatuses::ACCEPTED): Order
    {
        return (new Order())
            ->setUser($user)
            ->setClient($client)
            ->setTotalPrice($totalPrice)
            ->setOrderDate($orderDate)
            ->setStatus($status);
    }
}
