<?php

namespace App\Command;

use App\Repository\ProductRepository;
use App\Repository\Redis\RedisClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-products-to-redis',
    description: 'add products data to redis',
)]
final class AddProductsInfoToRedis extends Command
{
    public function __construct(
        private readonly RedisClient $redisClient,
        private readonly ProductRepository $productRepository,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $redisClient = $this->redisClient->getRedisClient();
        $allProducts = $this->productRepository->findAll();

        foreach ($allProducts as $product) {
            $redisClient->hmset(
                'product:'.$product->getId(),
                [
                    'name' => $product->getName(),
                ]
            );

            $output->writeln("Imported product: {$product->getName()}");
        }
        $output->writeln('All products imported to Redis successfully.');

        return Command::SUCCESS;
    }
}
