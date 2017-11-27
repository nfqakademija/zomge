<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrdersRepository extends EntityRepository
{
    public function getLatestTenOrders()
    {
        return $this->createQueryBuilder('orders')
            ->setMaxResults(10)
            ->orderBy('orders.id', 'DESC')
            ->getQuery()
            ->execute();
    }

    public function getFulfilledOrdersCount()
    {
        return $this->createQueryBuilder('orders')
            ->select('COUNT(orders)')
            ->where('orders.status = :status')
            ->setParameter('status', 3)
            ->getQuery()
            ->execute();
    }
}
