<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findOrdersByUser(User $user): array
    {
        return $this->createQueryBuilder('o')
            ->select('o', 'od', 'p')
            ->leftJoin('o.orderDetails', 'od')
            ->leftJoin('od.product', 'p')
            ->andWhere('o.user = :user')
            ->setParameter('user', $user)
            ->orderBy('o.id', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }
}
