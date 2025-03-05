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
    $chantiers = $user->getChantiers();

    // Récupère les missions de l'utilisateur connecté
    $missions = $userChantierRepository->createQueryBuilder('uc')
    ->join('uc.chantier', 'c')  // Jointure pour récupérer les chantiers associés
    ->addSelect('c')  // Sélection des chantiers
    ->where('uc.user = :user')  // Condition sur l'utilisateur
    ->setParameter('user', $user)
    ->getQuery()
    ->getResult();
    // Test : affiche le contenu de $missions pour voir ce qu'il contient
    dump($missions);

    return $this->render('planning/index.html.twig', [
        'missions' => $missions,
    ]);
}
}
