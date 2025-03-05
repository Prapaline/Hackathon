<?php  

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class UserDataSubscriber implements EventSubscriberInterface
{
    private RequestStack $requestStack;
    private Environment $twig;

    public function __construct(RequestStack $requestStack, Environment $twig)
    {
        $this->requestStack = $requestStack;
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        // Simule un utilisateur (à adapter selon comment tu récupères l'utilisateur)
        $user = ['last_name' => 'Dupont', 'first_name' => 'Jean'];

        // Passe les variables globales à Twig
        $this->twig->addGlobal('last_name', $user['last_name']);
        $this->twig->addGlobal('first_name', $user['first_name']);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
