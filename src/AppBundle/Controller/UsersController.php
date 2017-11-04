<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/users")
 */
class UsersController extends Controller
{

    /**
     * @Route("/", name="admin_users_index")
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        return $this->render('AppBundle:Dashboard:users.html.twig', array(
            'users' => $users
        ));
    }
}
