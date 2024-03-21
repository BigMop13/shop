<?php

namespace App\Dto;

final readonly class RedisProductSearchSingleOutput
{
    public function __construct(
        public string $id,
        public string $price,
        public string $photo,
        public string $name,
    ) {
    }
}
