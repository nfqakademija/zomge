<?php

namespace AppBundle\Controller;

use AppBundle\Form\MyProfileForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends Controller
{

    /**
     * @Route("/my_profile", name="users_profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(MyProfileForm::class, $this->getUser());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Your profile updated!');

            return $this->redirectToRoute('users_profile');
        }

        return $this->render('@App/Home/users_profile.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
