<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CheckUserController extends AbstractController
{
    #[Route(path: '/api/check_user', name: 'check_user', methods: [Request::METHOD_GET])]
    public function __invoke(Request $request): JsonResponse
    {
        return $this->json($this->getUser());
    }
}
