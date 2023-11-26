<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\OrderInput;
use App\Entity\OrderDetails;
use App\Repository\ProductRepository;
use App\Service\CreateFullOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class PlaceOrder extends AbstractController
{
    private const ERROR_MESSAGE = 'Unexpected error occured during processing your order, try again in a moment or contact our customer service';
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly CreateFullOrder $createFullOrder,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $orderInput = $this->serializer->deserialize($request->getContent(), OrderInput::class, 'json');
        try {
            $this->createFullOrder->saveOrder($orderInput, $this->getUser());
        } catch (\Exception) {
            return new JsonResponse(self::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return new JsonResponse('Order places successfully', Response::HTTP_CREATED);
    }
}
