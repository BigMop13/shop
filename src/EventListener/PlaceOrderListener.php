<?php

namespace App\EventListener;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Controller\PlaceOrderController;
use App\Dto\OrderInput;
use App\Repository\ProductRepository;
use App\Service\UpdateProductStockQuantity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class PlaceOrderListener implements EventSubscriberInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private EntityManagerInterface $entityManager,
        private UpdateProductStockQuantity $updateProductStockQuantity,
        private ProductRepository $productRepository,
    ) {
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['updateProductStockQuantity', EventPriorities::POST_WRITE],
        ];
    }

    public function updateProductStockQuantity(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if (Request::METHOD_POST === $request->getMethod() && PlaceOrderController::SUCCESS_MESSAGE === $response->getContent()) {
            $orderInput = $this->serializer->deserialize($request->getContent(), OrderInput::class, 'json');

            foreach ($orderInput->orderDetails as $orderDetails) {
                $this->updateProductStockQuantity->updateStockQuantity(
                    product: $this->productRepository->find($orderDetails->productId),
                    quantity: $orderDetails->quantity,
                );
            }

            $this->entityManager->flush();
        }
    }
}
