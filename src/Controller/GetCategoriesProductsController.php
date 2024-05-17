<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class GetCategoriesProductsController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {
    }

    #[Route(path: 'api/category_products/{categoryId}', name: 'get_category_products', methods: Request::METHOD_GET)]
    public function __invoke(int $categoryId): JsonResponse
    {
        return $this->json($this->productRepository->getProductsByCategoryId($categoryId));
    }
}
