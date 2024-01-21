<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

final class OrderInput
{
    public function __construct(
        #[SerializedName('total_price')]
        public int $totalPrice,
        #[SerializedName('order_date')]
        public \DateTimeImmutable $orderDate,
        /** @var OrderDetailsInput[] $orderDetails */
        #[SerializedName('order_details')]
        public array $orderDetails,
    ) {
    }
}
