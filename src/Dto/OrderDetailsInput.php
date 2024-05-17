<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class OrderDetailsInput
{
    public function __construct(
        #[Assert\Type(type: 'integer')]
        #[Assert\Positive]
        #[SerializedName('product_id')]
        public int $productId,
        #[Assert\Type(type: 'integer')]
        #[Assert\Positive]
        public int $quantity,
    ) {
    }
}
