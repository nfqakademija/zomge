<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Form\AdminSetOrderStatusForm;
use Symfony\Component\HttpFoundation\Request;
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
    public function indexAction(Request $request)
    {
        $orders = $this->getDoctrine()
            ->getRepository('AppBundle:Orders')
            ->findAll();

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', $this->getParameter('pagination_number'))
        );

        return $this->render('AppBundle:Dashboard:orders_index.html.twig', [
            'orders' => $result
        ]);
    }

    /**
     * @Route("/{id}/view", name="admin_orders_view")
     * @param Orders  $order
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Orders $order, Request $request)
    {
        $form = $this->createForm(AdminSetOrderStatusForm::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Order status updated successfully!');

            return $this->redirectToRoute('admin_orders_view', ['id' => $order->getId()]);
        }

        return $this->render('AppBundle:Dashboard:orders_view.html.twig', [
            'order' => $order,
            'form' => $form->createView()
        ]);
    }
}
