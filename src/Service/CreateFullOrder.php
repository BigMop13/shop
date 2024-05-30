<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\OrderDetailsInput;
use App\Dto\OrderInput;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\User;
use App\Factory\OrderDetailsFactory;
use App\Factory\OrderFactory;
use App\Helper\CalculateOrderPrice;
use App\Persister\ObjectPersister;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CreateFullOrder
{
    public function __construct(
        private ObjectPersister $persister,
        private OrderDetailsFactory $orderDetailsFactory,
        private OrderFactory $orderFactory,
        private ProductRepository $productRepository,
        private CalculateOrderPrice $calculateOrderPrice,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function saveOrder(OrderInput $orderInput, ?User $user): void
    {
        $order = $this->orderFactory->create(
            client: $user->getClient() ?? null,
            user: $this->prepareUser($user),
            totalPrice: $orderInput->totalPrice,
            orderDate: $orderInput->orderDate,
        );

        $this->entityManager->persist($order);
        $this->entityManager->flush();
        $orderDetails = $this->createOrderDetails($orderInput->orderDetails, $order);
        $order->setTotalPrice($this->calculateOrderPrice->calculateOrderTotalPrice($orderDetails));
        $orderDetails[] = $user->getClient() ?? null;

        $this->persister->saveMultipleObjects($orderDetails);
    }

    /**
     * @param OrderDetailsInput[] $orderDetails
     *
     * @return OrderDetails[]
     */
    private function createOrderDetails(array $orderDetails, Order $order): array
    {
        $orderDetailsArray = [];

        foreach ($orderDetails as $orderDetail) {
            $orderDetailsArray[] = $this->orderDetailsFactory->create(
                order: $order,
                product: $this->productRepository->find($orderDetail->productId),
                quantity: $orderDetail->quantity,
            );
        }

        return $orderDetailsArray;
    }

    private function prepareUser(?User $user): ?User
    {
        if (null !== $user && !$this->entityManager->contains($user)) {
            return $this->entityManager->find(User::class, $user->getId());
        }

        return $user;
    }
}
