<?php

namespace AppBundle\Service;

class MailSender
{

    private $mailer;

    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail($order)
    {
        $message = (new \Swift_Message('Zomge: New Order #' . $order->getOrderNumber()))
            ->setFrom('zomge@example.com')
            ->setTo($order->getUser()->getEmail())
            ->setBody(
                $this->twig->render('AppBundle:Emails:Order.html.twig', [
                        'order' => $order
                    ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
