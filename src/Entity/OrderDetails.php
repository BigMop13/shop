<?php

namespace App\Entity;

use App\Repository\OrderDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailsRepository::class)]
class OrderDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $orderId = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $productId = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?Order
    {
        return $this->orderId;
    }

    public function setOrderId(?Order $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(?Product $productId): static
    {
        $this->productId = $productId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }
}
