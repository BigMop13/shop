<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\OrderInput;
use App\Entity\OrderDetails;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

final class PlaceOrder extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly SerializerInterface $serializer,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $order = $this->serializer->deserialize($request->getContent(), OrderInput::class, 'json');

    }
}
