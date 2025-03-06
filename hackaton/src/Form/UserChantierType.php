<?php

namespace App\Form;

use App\Entity\UserChantier;
use App\Entity\Chantier;
use App\Entity\User;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chantier', EntityType::class, [
                'class' => Chantier::class,
                'choice_label' => 'name',
                'label' => 'Chantier',
            ])
            ->add('start_date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'required' => true,
            ])
            ->add('end_date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'required' => true,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',  // Ou 'firstName' si tu veux afficher le prénom
                'label' => 'Sélectionner un utilisateur',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserChantier::class,
        ]);
    }
}
