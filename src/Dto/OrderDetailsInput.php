<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

final class OrderDetailsInput
{
    public function __construct(
        #[SerializedName('product_id')]
        public int $productId,
        public int $quantity,
    ) {
    }
}
