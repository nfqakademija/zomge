<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrdersRepository extends EntityRepository
{
    public function getLatestTenUsers()
    {
        return $this->createQueryBuilder('orders')
            ->setMaxResults(10)
            ->orderBy('orders.id', 'DESC')
            ->getQuery()
            ->execute();
    }
}
