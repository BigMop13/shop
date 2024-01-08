<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\Redis\RedisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class SearchProductController extends AbstractController
{
    public function __construct(
        private readonly RedisRepository $redisRepository,
    )
    {
    }

    #[Route(path: 'api/products_searcher', name: 'products_searcher', methods: Request::METHOD_GET)]
    public function __invoke(Request $request): JsonResponse
    {
        $searchInput = $request->get('name');

        return $this->json($this->redisRepository->getProductsFromSearcher($searchInput));
    }
}
