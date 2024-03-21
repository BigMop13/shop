<?php

namespace App\Repository\Redis;

use App\Dto\RedisProductSearchSingleOutput;

final readonly class RedisRepository
{
    private const PRODUCTS_REDIS_INDEX = 'productIndex';

    public function __construct(private RedisClient $client)
    {
    }

    public function getProductsFromSearcher(string $searcherInput): array
    {
        return $this->transformSearchQueryIntoObjects($this->client->getRedisClient()->executeRaw(['FT.SEARCH', self::PRODUCTS_REDIS_INDEX, $searcherInput.'*', 'LIMIT', '0', '5']));
    }

    /**
     * @return RedisProductSearchSingleOutput[]
     */
    private function transformSearchQueryIntoObjects(array $redisSearchQueryResult): array
    {
        $products = [];
        $count = count($redisSearchQueryResult);

        for ($i = 1; $i < $count; $i += 2) {
            $id = $redisSearchQueryResult[$i];
            $details = $redisSearchQueryResult[$i + 1];

            $productDto = new RedisProductSearchSingleOutput(
                $id,
                $details[1], // price
                $details[3], // photo
                $details[5]  // name
            );

            $products[] = $productDto;
        }

        return $products;
    }
}
