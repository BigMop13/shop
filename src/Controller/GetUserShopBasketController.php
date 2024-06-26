<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GetUserShopBasketController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return $this->json($this->getUser()->getOrders());
    }
}
