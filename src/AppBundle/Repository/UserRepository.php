<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * @return User[]
     */
    public function getLatestTenUsers()
    {
        return $this->createQueryBuilder('user')
            ->setMaxResults(10)
            ->orderBy('user.id', 'DESC')
            ->getQuery()
            ->execute();
    }

    /**
     * @return User[]
     */
    public function getUsersCount()
    {
        return $this->createQueryBuilder('user')
            ->select('COUNT(user)')
            ->getQuery()
            ->execute();
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function getUserQuery()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT u from AppBundle:User u');
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function getUserOrdersQuery($userId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT o FROM AppBundle:Orders o WHERE o.user_id = :userId')
            ->setParameter('userId', $userId);
    }
}
