<?php

declare(strict_types=1);

namespace App\Dto;

final class OrderInput
{
    public function __construct(
        public int $totalPrice,
        public \DateTimeImmutable $orderDate,
        /** @var OrderDetailsInput[] $orderDetails */
        public array $orderDetails,
    ) {
    }
}
