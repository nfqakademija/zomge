<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Security\OrderVoter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PayController extends Controller
{

    /**
     * @Route("/pay/{orderNumber}", name="pay_order")
     * @param Orders $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function payAction(Orders $order)
    {
        $this->denyAccessUnlessGranted(OrderVoter::USER_ORDER, $order);

        $em = $this->getDoctrine()->getManager();
        $order->setIsPaid(1);
        $em->flush();

        $this->addFlash('success', 'Yay! Your order have been been.');

        return $this->redirectToRoute('orders_view', ['orderNumber' => $order->getOrderNumber()]);
    }
}
