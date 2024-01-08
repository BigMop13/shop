<?php

namespace App\Repository\Redis;

use App\Repository\Redis\RedisClient;

final readonly class RedisRepository
{
    private const PRODUCTS_SET_NAME = 'productsSet';
    public function __construct(private RedisClient $client)
    {
    }

    /**
     * @return string[]
     */
    public function getProductsFromSearcher(string $searcherInput): array
    {
        $allProducts = $this->client->getRedisClient()->smembers(self::PRODUCTS_SET_NAME);

        return array_filter($allProducts, function (string $product) use ($searcherInput): bool {
            return str_contains($product, $searcherInput);
        });
    }
}
