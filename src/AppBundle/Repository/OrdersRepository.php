<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Orders;
use Doctrine\ORM\EntityRepository;

class OrdersRepository extends EntityRepository
{

    /**
     * @param $user
     * @return Orders[]
     */
    public function orderByNewest($user)
    {
        return $this->createQueryBuilder('orders')
            ->where('orders.user = :user')
            ->setParameter('user', $user)
            ->orderBy('orders.id', 'DESC')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Orders[]
     */
    public function getLatestTenOrders()
    {
        return $this->createQueryBuilder('orders')
            ->setMaxResults(10)
            ->orderBy('orders.id', 'DESC')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Orders[]
     */
    public function getFulfilledOrdersCount()
    {
        return $this->createQueryBuilder('orders')
            ->select('COUNT(orders)')
            ->where('orders.status = :status')
            ->setParameter('status', 3)
            ->getQuery()
            ->execute();
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function getOrdersQuery()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT o from AppBundle:Orders o ORDER BY o.id DESC');
    }
}
