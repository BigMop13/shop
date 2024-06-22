<?php

namespace App\Dto;

final readonly class RedisProductSearchSingleOutput
{
    public function __construct(
        public string $name,
    ) {
    }
}
