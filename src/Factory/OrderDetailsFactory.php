<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\Product;

final class OrderDetailsFactory
{
    public function create(Order $order, Product $product, int $quantity): OrderDetails
    {
        return (new OrderDetails())
            ->setOrder($order)
            ->setProduct($product)
            ->setPrice($this->getOrderPrice($product->getPrice(), $quantity))
            ->setQuantity($quantity);
    }

    private function getOrderPrice(int $price, int $quantity): int
    {
        return $price * $quantity;
    }
}