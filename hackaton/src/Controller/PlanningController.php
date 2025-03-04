<?php

namespace App\Controller;

use App\Repository\UserChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/planning')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
class PlanningController extends AbstractController
{
    #[Route('/', name: 'app_planning')]
    public function index(UserChantierRepository $userChantierRepository): Response
{
    $user = $this->getUser();

    // Récupère les missions de l'utilisateur connecté
    $missions = $userChantierRepository->findBy(['userid' => $user]);

    // Test : affiche le contenu de $missions pour voir ce qu'il contient
    dump($missions);

    return $this->render('planning/index.html.twig', [
        'missions' => $missions,
    ]);
}
}
