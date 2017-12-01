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
     * @param Request      $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, FileUploader $fileUploader)
    {
        $user = $this->getUser();
        $form = $this->createForm(BuyNowForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $form = $form->getData();

            $file = $form->getPhoto()->getPhoto();

            $fileName = $fileUploader->upload($file);

            $orderNumber = $this->orderNumber();

            $order = new Orders();
            $order->setOrderNumber($orderNumber);
            $order->setPhoto($fileName);
            $order->setBackPanel($form->getBackPanel());
            $order->setBackPanelPrice($form->getBackPanel());
            $order->setUser($user);
            $order->setStatus(1);

            $em->persist($order);
            $em->flush();

            $this->addFlash('success', 'Yay! Your order have been accepted.');

            return $this->redirectToRoute('orders_view', ['orderNumber' => $orderNumber]);
        }

        return $this->render('AppBundle:Home:buy_now.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param int $length
     * @return string
     */
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
