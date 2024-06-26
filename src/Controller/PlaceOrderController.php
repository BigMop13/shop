<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\OrderInput;
use App\Message\PlaceOrderEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PlaceOrderController extends AbstractController
{
    private const ERROR_MESSAGE = 'Unexpected error occured during processing your order, try again in a moment or contact our customer service';
    final public const SUCCESS_MESSAGE = 'Order placed successfully';

    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly MessageBusInterface $messageBus,
        private readonly ValidatorInterface $validator,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $orderInput = $this->serializer->deserialize($request->getContent(), OrderInput::class, 'json');
        $this->validator->validate($orderInput);
        try {
            $this->messageBus->dispatch(new PlaceOrderEvent(
                orderInput: $orderInput,
                user: $this->getUser(),
            ));
        } catch (\Exception) {
            return new JsonResponse(self::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(self::SUCCESS_MESSAGE, Response::HTTP_CREATED);
    }
}
