<?php

namespace AppBundle\Controller;

use AppBundle\Form\RegisterForm;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{

    /**
     * @Route("/login", name="user_login")
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $error = $authUtils->getLastAuthenticationError();

        $lastUsername = $authUtils->getLastUsername();

        return $this->render('AppBundle:Home:login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
