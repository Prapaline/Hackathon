<?php
namespace App\Controller;

use App\Entity\UserChantier;
use App\Form\UserChantierType;
use App\Repository\UserChantierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        // Récupère l'utilisateur courant
        $user = $this->getUser();

        // Vérifie s'il y a des chevauchements de dates
        $overlappingChantiers = $entityManager->getRepository(UserChantier::class)
            ->createQueryBuilder('uc')
            ->where('uc.user = :user')
            ->andWhere(
                '(uc.start_date BETWEEN :startDate AND :endDate) OR (uc.end_date BETWEEN :startDate AND :endDate) OR (:startDate BETWEEN uc.start_date AND uc.end_date)'
            )
            ->setParameter('user', $user)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();

        if (count($overlappingChantiers) > 0) {
            // S'il y a des chevauchements, tu peux ajouter un message d'erreur
            $this->addFlash('error', 'L\'utilisateur a déjà un chantier dans cette période.');

            // Retourne au formulaire avec un message d'erreur
            return $this->render('user_chantier/new.html.twig', [
                'form' => $form->createView(),
            ]);
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
