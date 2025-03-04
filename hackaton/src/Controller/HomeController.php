<?php

namespace App\Controller;

use App\Entity\Chantier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer les 3 derniers chantiers depuis la base de données
        $chantiers = $entityManager->getRepository(Chantier::class)
            ->findBy([], ['start_date' => 'DESC'], 3);

        return $this->render('home/index.html.twig', [
            'chantiers' => $chantiers,
        ]);
    }
}