<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class UserRegisterInput
{
    public function __construct(
        #[Assert\NotBlank(message: 'Pole email jest obowiązkowe')]
        public mixed $email,
        #[Assert\PasswordStrength(message: 'Hasło musi byc wystarczająco silne')]
        public mixed $password,
        public mixed $createdAt = new \DateTimeImmutable(),
    ) {
    }
}
