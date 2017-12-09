<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends Controller
{

    /**
     * @Route("/connect/facebook", name="connect_facebook")
     */
    public function connectAction()
    {
        return $this->get('oauth2.registry')
            ->getClient('facebook_main')
            ->redirect();
    }

    /**
     * @Route("/connect/facebook/check", name="connect_facebook_check")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectCheckAction(Request $request)
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
    }

}