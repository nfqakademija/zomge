<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/")
 */
class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Home:index.html.twig', []);
    }

    /**
     * @Route("/specs", name="specs")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function specsAction()
    {
        return $this->render('AppBundle:Home:specs.html.twig', []);
    }
}
