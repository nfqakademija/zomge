<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends Controller
{

    /**
     * @Route("/", name="admin_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $latestUsers = $em->getRepository('AppBundle:User')
            ->getLatestTenUsers();

        $usersCount = $em->getRepository('AppBundle:User')
            ->getUsersCount();

        $latestOrders = $em->getRepository('AppBundle:Orders')
            ->getLatestTenOrders();

        $fulfilledOrdersCount = $em->getRepository('AppBundle:Orders')
            ->getFulfilledOrdersCount();

        return $this->render('AppBundle:Dashboard:index.html.twig', [
            'latestUsers'          => $latestUsers,
            'usersCount'           => $usersCount,
            'latestOrders'         => $latestOrders,
            'fulfilledOrdersCount' => $fulfilledOrdersCount
        ]);
    }
}
