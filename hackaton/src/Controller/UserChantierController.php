<?php

namespace App\Controller;

use App\Entity\UserChantier;
use App\Form\UserChantierType;
use App\Repository\UserChantierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/userchantier')]
final class UserChantierController extends AbstractController
{
    #[Route(name: 'app_user_chantier_index', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $userChantier = new UserChantier();
    $form = $this->createForm(UserChantierType::class, $userChantier);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $startDate = $form->get('start_date')->getData();
        $endDate = $form->get('end_date')->getData();

        // Vérifie si c'est déjà un DateTimeImmutable
        if ($startDate instanceof \DateTime && !$startDate instanceof \DateTimeImmutable) {
            $startDate = \DateTimeImmutable::createFromMutable($startDate);
        }
        if ($endDate instanceof \DateTime && !$endDate instanceof \DateTimeImmutable) {
            $endDate = \DateTimeImmutable::createFromMutable($endDate);
        }

        $userChantier->setStartDate($startDate);
        $userChantier->setEndDate($endDate);

        $entityManager->persist($userChantier);
        $entityManager->flush();

        return $this->redirectToRoute('app_user_chantier_index');
    }

    return $this->render('user_chantier/new.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
