<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserEditForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/users")
 */
class UsersController extends Controller
{

    /**
     * @Route("/", name="admin_users_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')
            ->getAllUsers();

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', $this->getParameter('pagination_number'))
        );

        return $this->render('AppBundle:Dashboard:users_index.html.twig', [
            'users' => $result
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_users_edit")
     * @param Request $request
     * @param User    $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(UserEditForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'User updated!');

            return $this->redirectToRoute('admin_users_index');
        }

        return $this->render('AppBundle:Dashboard:users_edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/orders", name="admin_users_orders")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewOrderAction(User $user, Request $request)
    {
        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $user->getOrders(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', $this->getParameter('pagination_number'))
        );

        return $this->render('AppBundle:Dashboard:users_orders.html.twig', [
            'user' => $user,
            'orders' => $result
        ]);
    }
}
