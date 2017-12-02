<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Security\OrderVoter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserOrdersController extends Controller
{

    /**
     * @Route("/orders", name="users_orders")
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param User $user
     */
    public function indexAction()
    {
        $orders = $this->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Orders')
        ->orderByNewest($this->getUser());

        return $this->render('AppBundle:Home:orders.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/orders/{orderNumber}", name="orders_view")
     * @param Orders $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewOrderAction(Orders $order)
    {
        $this->denyAccessUnlessGranted(OrderVoter::USER_ORDER, $order);

        return $this->render('AppBundle:Home:orders_view.html.twig', [
            'order' => $order
        ]);
    }
}
