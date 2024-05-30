<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\UserRegisterInput;
use App\Service\RegisterUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
final readonly class RegisterUserController
{
    public function __construct(
        private SerializerInterface $serializer,
        private RegisterUser $registerUser,
        private ValidatorInterface $validator,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var UserRegisterInput $userData */
        $userData = $this->serializer->deserialize($request->getContent(), UserRegisterInput::class, 'json');
        $this->validator->validate($userData);

        $this->registerUser->register($userData);

        return new JsonResponse('', Response::HTTP_CREATED);
    }
}
