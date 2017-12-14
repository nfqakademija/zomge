<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('AppBundle:Home:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
        /*
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(LoginForm::class);

        return $this->render('AppBundle:Home:login.html.twig', [
            'form' => $form->createView()
        ]);*/
    }
}
