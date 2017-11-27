<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getLatestTenUsers()
    {
        return $this->createQueryBuilder('user')
            ->setMaxResults(10)
            ->orderBy('user.id', 'DESC')
            ->getQuery()
            ->execute();
    }
}
