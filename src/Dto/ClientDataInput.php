<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class ClientDataInput
{
    public function __construct(
        #[Assert\Type(type: 'string')]
        #[Assert\Length(min: 2, max: 100)]
        public mixed $name,
        #[Assert\Type(type: 'string')]
        #[Assert\Length(min: 2, max: 100)]
        public mixed $surname,
        #[Assert\Type(type: 'string')]
        #[Assert\Length(min: 2, max: 100)]
        public mixed $address,
        #[Assert\Type(type: 'string')]
        #[Assert\Length(min: 2, max: 100)]
        #[Assert\Email]
        public mixed $email,
        #[Assert\Type(type: 'string')]
        #[Assert\Length(exactly: 9)]
        #[SerializedName('phone_number')]
        public mixed $phoneNumber,
    ) {
    }
}
