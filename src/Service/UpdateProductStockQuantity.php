<?php

namespace App\Service;

use App\Entity\Product;

final class UpdateProductStockQuantity
{
    public function updateStockQuantity(Product $product, int $quantity): void
    {
        $product->setStockQuantity($product->getStockQuantity() - $quantity);
    }
}
