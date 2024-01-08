<?php

declare(strict_types=1);

namespace App\Repository\Redis;

use Predis\Client;

class RedisClient
{
    public function __construct(private readonly string $redisUrl, private Client $client)
    {
        $this->client = new Client([
            'host' => $this->redisUrl,
        ]);
    }

    public function getRedisClient(): Client
    {
        return $this->client;
    }
}
