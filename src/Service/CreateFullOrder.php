<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\OrderDetailsInput;
use App\Dto\OrderInput;
use App\Entity\Client;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\User;
use App\Factory\ClientFactory;
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
        private ClientFactory $clientFactory,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function saveOrder(OrderInput $orderInput, ?User $user): void
    {
        $client = $this->prepareClient($user, $orderInput);
        $order = $this->orderFactory->create(
            client: $client,
            user: $this->prepareUser($user),
            totalPrice: $orderInput->totalPrice,
            orderDate: new \DateTimeImmutable($orderInput->orderDate),
        );

        $this->entityManager->persist($order);
        $this->entityManager->flush();
        $orderDetails = $this->createOrderDetails($orderInput->orderDetails, $order);
        $order->setTotalPrice($this->calculateOrderPrice->calculateOrderTotalPrice($orderDetails));
        $orderDetails[] = $client;

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

    private function prepareClient(?User $user, OrderInput $orderInput): Client
    {
        if ($user) {
            $client = $user->getClient();
            if ($client && !$this->entityManager->contains($client)) {
                return $this->entityManager->find(Client::class, $client->getId());
            }

            return $user->getClient();
        }
        $client = $this->clientFactory->create($orderInput->client);
        $this->persister->saveObject($client);

        return $client;
    }
}
