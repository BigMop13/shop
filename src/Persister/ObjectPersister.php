<?php

declare(strict_types=1);

namespace App\Persister;

use Doctrine\ORM\EntityManagerInterface;

final readonly class ObjectPersister
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function saveObject(object $object): void
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    /**
     * @param object[] $objects
     */
    public function saveMultipleObjects(array $objects): void
    {
        foreach ($objects as $object) {
            $this->entityManager->persist($object);
        }

        $this->entityManager->flush();
    }
}
