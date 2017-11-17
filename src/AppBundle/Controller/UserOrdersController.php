<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
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
        return $this->render('AppBundle:Home:orders.html.twig', [
            'orders' => $this->getUser()->getOrders()
        ]);
    }

    /**
     * @Route("/orders/{orderNumber}", name="orders_view")
     * @param Orders $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewOrderAction(Orders $order)
    {
        if (!$this->isGranted('USER_ORDER', $order)) {
            throw $this->createAccessDeniedException('NO!');
        }

        return $this->render('AppBundle:Home:orders_view.html.twig', [
            'order' => $order
        ]);
    }
}
