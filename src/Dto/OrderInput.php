<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class OrderInput
{
    public function __construct(
        /** @var ClientDataInput $client */
        #[Assert\Valid]
        #[SerializedName('client')]
        public mixed $client,
        #[Assert\Type(type: 'integer')]
        #[SerializedName('total_price')]
        public mixed $totalPrice,
        #[Assert\Type(type: 'string')]
        #[SerializedName('order_date')]
        public mixed $orderDate,
        /** @var OrderDetailsInput[] $orderDetails */
        #[Assert\Type(type: 'array')]
        #[Assert\Valid]
        #[SerializedName('order_details')]
        public mixed $orderDetails,
    ) {
    }
}
