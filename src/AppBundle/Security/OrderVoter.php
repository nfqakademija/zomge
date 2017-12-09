<?php

namespace AppBundle\Security;

use AppBundle\Entity\Orders;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class OrderVoter extends Voter
{
    const USER_ORDER = 'USER_ORDER';

    protected function supports($attribute, $object)
    {
        if ($attribute != self::USER_ORDER) {
            return false;
        }
        if (!$object instanceof Orders) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if ($subject->getUser() == $token->getUser()) {
            return true;
        }

        return false;
    }
}
