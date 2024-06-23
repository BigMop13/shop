<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
final class GetProductByNameController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {
    }

    #[Route(path: '/api/get_product_by_name', name: 'get_product_by_name', methods: Request::METHOD_GET)]
    public function __invoke(Request $request): JsonResponse
    {
        $name = $request->get('name');

        return $this->json($this->productRepository->findOneBy(['name' => $name]));
    }
}
