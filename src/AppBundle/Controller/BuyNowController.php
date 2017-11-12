<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Entity\User;
use AppBundle\Form\BuyNowForm;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BuyNowController extends Controller
{

    /**
     * @Route("/buy_now", name="buy_now")
     */
    public function indexAction(Request $request, FileUploader $fileUploader)
    {
        $user = $this->getUser();
        $form = $this->createForm(BuyNowForm::class, null, ['user' => $user]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository(User::class)->find($user);

            $file = $form->get('picture')->getData();
            $fileName = $fileUploader->upload($file);

            $user->setPhoneNumber($form->get('phone_number')->getData());
            $user->setAddress($form->get('address')->getData());
            $user->setCity($form->get('city')->getData());
            $user->setPostalCode($form->get('postal_code')->getData());

            $order = new Orders();
            $order->setOrderNumber($this->orderNumber());
            $order->setPhoto($fileName);
            $order->setUser($user);
            $order->setStatus('1');

            $em->persist($order);
            $em->flush();
        }

        return $this->render('AppBundle:Home:buy_now.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function orderNumber($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
