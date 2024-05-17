<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ClientDataInput;
use App\Entity\Client;

final class ClientFactory
{
    public function create(ClientDataInput $clientDataInput): Client
    {
        return (new Client())
            ->setName($clientDataInput->name)
            ->setSurname($clientDataInput->surname)
            ->setAddress($clientDataInput->address)
            ->setEmail($clientDataInput->email)
            ->setPhoneNumber($clientDataInput->phoneNumber);
    }
}
