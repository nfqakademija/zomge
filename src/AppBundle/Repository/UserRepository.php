<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * @return mixed
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
     * @return mixed
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
    public function getAllUsers()
    {
        $em = $this->getEntityManager();

        return $em->createQuery('SELECT u from AppBundle:User u');
    }
}
