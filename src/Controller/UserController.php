<?php
declare(strict_types=1);

namespace App\Controller;

use App\Dto\UserRegisterInput;
use App\Service\RegisterUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
final readonly class UserController
{
    public function __construct(
        private SerializerInterface $serializer,
        private RegisterUser $registerUser,
    )
    {
    }
    public function __invoke(Request $request): JsonResponse
    {
        /** @var UserRegisterInput $userData */
        $userData = $this->serializer->deserialize($request->getContent(), UserRegisterInput::class, 'json');
        $this->registerUser->register($userData);
    // validate input
        return new JsonResponse('', Response::HTTP_NO_CONTENT);
    }
}