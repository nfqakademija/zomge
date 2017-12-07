<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Form\BuyNowForm;
use AppBundle\Form\BuyNowStepTwoForm;
use AppBundle\Service\FileUploader;
use AppBundle\Form\BuyNowStepOneForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class BuyNowController extends Controller
{

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/buy_now", name="step_one")
     * @param Request      $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepOneAction(Request $request, FileUploader $fileUploader)
    {
        $form = $this->createForm(BuyNowStepOneForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $form = $form->getData();

            $file = $form->getPhoto();
            $fileName = $fileUploader->upload($file);

            $this->session->set('photo', $fileName);
            $this->session->set('backPanel', $form->getBackPanel());

            return $this->redirectToRoute('step_two');
        }

        return $this->render('AppBundle:Home:buy_now_step_one.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/buy_now/2", name="step_two")
     * @param Request      $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function stepTwoAction(Request $request)
    {
        if (! $this->getUser()) {
            $this->addFlash('warning', 'You need to login.');

            return $this->redirectToRoute('login');
        }

        $user = $this->getUser();

        $form = $this->createForm(BuyNowStepTwoForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $form = $form->getData();

            $orderNumber = $this->orderNumber();

            $totalPrice = 399 + $form->setBackPanelPrice($this->session->get('backPanel'));

            $order = new Orders();
            $order->setOrderNumber($orderNumber);
            $order->setPhoto($this->session->get('photo'));
            $order->setBackPanel($this->session->get('backPanel'));
            $order->setBackPanelPrice($this->session->get('backPanel'));
            $order->setTotalPrice($totalPrice);
            $order->setIsPaid(0);
            $order->setUser($user);
            $order->setStatus(1);

            $em->persist($order);
            $em->flush();

            $this->addFlash('success', 'Yay! Your order have been accepted.');

            return $this->redirectToRoute('orders_view', ['orderNumber' => $orderNumber]);
        }

        return $this->render('AppBundle:Home:buy_now_step_two.html.twig', [
            'form' => $form->createView()
        ]);
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
