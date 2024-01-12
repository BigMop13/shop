<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dictionary\OrderStatuses;
use App\Entity\Order;
use App\Entity\User;

final class OrderFactory
{
    public function create(User $user, int $totalPrice, \DateTimeImmutable $orderDate, string $status = OrderStatuses::ACCEPTED): Order
    {
        return (new Order())
            ->setUser($user)
            ->setTotalPrice($totalPrice)
            ->setOrderDate($orderDate)
            ->setStatus($status);
    }
}
