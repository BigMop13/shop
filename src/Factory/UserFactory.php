<?php
declare(strict_types=1);

namespace App\Factory;

use App\Dto\UserRegisterInput;
use App\Entity\User;

final class UserFactory
{
    public function create(UserRegisterInput $registerInput): User
    {
        return (new User())
            ->setEmail($registerInput->email)
            ->setPassword($registerInput->password)
            ->setCreatedAt($registerInput->createdAt);
    }
}