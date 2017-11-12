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
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        return $this->render('AppBundle:Dashboard:users_index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_users_edit")
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
}
