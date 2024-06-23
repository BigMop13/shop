<?php

namespace App\Repository\Redis;

use App\Dto\RedisProductSearchSingleOutput;

final readonly class RedisRepository
{
    public const PRODUCTS_REDIS_INDEX = 'productIndex';

    public function __construct(private RedisClient $client)
    {
    }

    public function getProductsFromSearcher(string $searcherInput): array
    {
        return $this->transformSearchQueryIntoObjects($this->client->getRedisClient()
            ->executeRaw(['FT.SEARCH', self::PRODUCTS_REDIS_INDEX, $searcherInput.'*', 'LIMIT', '0', '5']));
    }

    /**
     * @return RedisProductSearchSingleOutput[]
     */
    private function transformSearchQueryIntoObjects(array $redisSearchQueryResult): array
    {
        $products = [];
        $count = count($redisSearchQueryResult);

        for ($i = 2; $i < $count; $i += 2) {
            $productDto = new RedisProductSearchSingleOutput(
                $redisSearchQueryResult[$i][1],
            );

            $products[] = $productDto;
        }

        return $products;
    }
}
