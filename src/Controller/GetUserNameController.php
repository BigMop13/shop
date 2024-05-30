<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class GetUserNameController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        $client = $this->getUser()->getClient();

        return $this->json([
            'name' => $client->getUser()->getName(),
            'surname' => $client->getUser()->getSurname(),
        ]);
    }
}