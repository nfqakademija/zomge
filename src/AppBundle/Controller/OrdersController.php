<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/orders")
 */
class OrdersController extends Controller
{

    /**
     * @Route("/", name="admin_orders_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $orders = $this->getDoctrine()
            ->getRepository('AppBundle:Orders')
            ->findAll();

        return $this->render('AppBundle:Dashboard:orders_index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/{id}/view", name="admin_orders_view")
     * @param Orders $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Orders $order)
    {
        return $this->render('AppBundle:Dashboard:orders_view.html.twig', [
            'order' => $order
        ]);
    }
}
