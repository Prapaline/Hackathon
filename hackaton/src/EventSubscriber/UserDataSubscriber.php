<?php  

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;
use Symfony\Bundle\SecurityBundle\Security;


class UserDataSubscriber implements EventSubscriberInterface
{
    private RequestStack $requestStack;
    private Environment $twig;
    private Security $security;


    public function __construct(RequestStack $requestStack, Environment $twig, Security $security)
    {
        $this->requestStack = $requestStack;
        $this->twig = $twig;
        $this->security = $security;

    }

    public function onKernelController(ControllerEvent $event): void
{
   
    $user = $this->security->getUser();

    if ($user) { 
        $this->twig->addGlobal('last_name', $user->getLastName());
        $this->twig->addGlobal('first_name', $user->getFirstName());
    }
}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
