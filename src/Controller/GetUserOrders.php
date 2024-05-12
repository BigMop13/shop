<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class GetUserOrders extends AbstractController
{
    public function __construct(
        private OrderRepository $orderRepository,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return $this->json($this->orderRepository->findOrdersByUser($this->getUser()));
    }
}
