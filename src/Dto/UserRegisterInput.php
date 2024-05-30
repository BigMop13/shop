<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;

final readonly class UserRegisterInput
{
    public function __construct(
        #[Assert\NotBlank(message: 'Pole email jest obowiązkowe')]
        public mixed $email,
        #[Assert\PasswordStrength(minScore: PasswordStrength::STRENGTH_WEAK, message: 'Hasło musi byc wystarczająco silne')]
        public mixed $password,
        #[Assert\Valid]
        #[SerializedName('client_data_input')]
        public ClientDataInput $clientDataInput,
        public mixed $createdAt = new \DateTimeImmutable(),
    ) {
    }
}
