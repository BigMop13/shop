<?php

declare(strict_types=1);

namespace App\Helper;

use App\Entity\OrderDetails;

final readonly class CalculateOrderPrice
{
    /**
     * @param OrderDetails[] $orderDetails
     */
    public function calculateOrderTotalPrice(array $orderDetails): int
    {
        $totalPrice = 0;

        foreach ($orderDetails as $orderDetail){
            $totalPrice += $orderDetail->getQuantity() * $orderDetail->getProduct()->getPrice();
        }

        return $totalPrice;
    }
}