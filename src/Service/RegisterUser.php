<?php
declare(strict_types=1);

namespace App\Service;

use App\Dto\UserRegisterInput;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Persister\ObjectPersister;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class RegisterUser
{
    public function __construct(
        private UserFactory $userFactory,
        private UserPasswordHasherInterface $passwordHasher,
        private ObjectPersister $persister,
    )
    {
    }

    public function register(UserRegisterInput $registerInput): void
    {
        $user = $this->userFactory->create($registerInput);
        $this->hashPassword($user);
        $this->persister->saveObject($user);
    }

    private function hashPassword(User $user): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );

        $user->setPassword($hashedPassword);
    }
}