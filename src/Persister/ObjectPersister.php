<?php
declare(strict_types=1);

namespace App\Persister;

use Doctrine\ORM\EntityManagerInterface;

final readonly class ObjectPersister
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function saveObject(Object $object): void
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }
}