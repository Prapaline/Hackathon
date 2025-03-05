<?php

namespace App\Controller;

use App\Entity\Chantier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
              // Récupérer l'utilisateur connecté
              $user = $this->getUser();

              if (!$user) {
                  throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
              }
      
              // Récupérer le prénom et le nom de l'utilisateur connecté
              $firstName = $user->getFirstName();
              $lastName = $user->getLastName();
      

        // Récupérer les 3 derniers chantiers depuis la base de données
        $chantiers = $entityManager->getRepository(Chantier::class)
            ->findBy([], ['start_date' => 'DESC'], 3);

        return $this->render('home/index.html.twig', [
            'chantiers' => $chantiers,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);
    }
}