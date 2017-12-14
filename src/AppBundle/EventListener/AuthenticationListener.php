<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AuthenticationListener
{
    private $clientRegistry;
    private $em;

    /**
     * AuthenticationListener constructor.
     * @param ClientRegistry         $clientRegistry
     * @param EntityManagerInterface $em
     */
    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onSuccess(InteractiveLoginEvent $event)
    {
        if ($event->getRequest()->getPathInfo() !== '/connect/facebook/check') {
            return;
        }

        $token = $event->getAuthenticationToken()->getUser()->getFacebookToken();

        $client = $this->clientRegistry->getClient('facebook_main');

        $provider = $client->getOAuth2Provider();
        $longLivedToken = $provider->getLongLivedAccessToken($token);

        $facebookUser = $client->fetchUserFromToken($longLivedToken);

        $user = $this->em->getRepository(User::class)
            ->findOneBy(['facebookId' => $facebookUser->getId()]);

        $user->setFacebookPhoto($facebookUser->getPictureUrl());
        $this->em->flush();
    }
}
