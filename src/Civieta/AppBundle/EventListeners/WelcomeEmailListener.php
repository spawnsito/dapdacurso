<?php
/**
 * User: Daniel Cruz
 * Date: 25/01/2015
 * Time: 20:25
 */

namespace Civieta\AppBundle\EventListeners;


use Civieta\AppBundle\Event\CustomerCreatedEvent;

class WelcomeEmailListener
{
    /** @var \Swift_Mailer */
    private $mailer;
    /** @var  \Twig_Environment */
    private $viewEngine;

    function __construct($mailer, $viewEngine)
    {
        $this->mailer = $mailer;
        $this->viewEngine = $viewEngine;
    }

    public function onCustomerCreated(CustomerCreatedEvent $event)
    {
        $customer = $event->getCustomer();

        $body = $this->viewEngine->render('::Email/welcome_customer.html.twig', ['customer' => $customer]);

        $message = $this->mailer->createMessage()
            ->setSubject('Bienvenido a CM')
            ->setTo($customer->getEmails()[0])
            ->setBody($body);

       $this->mailer->send($message);

    }
}