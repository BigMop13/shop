<?php

declare(strict_types=1);

namespace App\Dto;

final class OrderDetailsInput
{
    public function __construct(
        public int $orderId,
        public int $productId,
        public int $quantity,
    )
    {
    }
}