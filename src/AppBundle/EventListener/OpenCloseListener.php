<?php

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class OpenCloseListener implements EventSubscriberInterface {
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function bye(GetResponseEvent $event) {
        if (!$event->isMasterRequest()) {
            return;
        }
        $h = date('H');
        if (20 >=  $h && $h <= 8) {
            return;
        }

        $body = $this->twig->render('openClose.html.twig');
        $response = new Response($body);

        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'bye'];
    }
}