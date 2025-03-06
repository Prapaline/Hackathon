<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('location')
            ->add('description')
            ->add('status')
            ->add('start_date', null, [
                'widget' => 'single_text',
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])
        /*     ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ]) */
            ->add('start_date', null, [
                'widget' => 'single_text',
                'attr' => [
                    'type' => 'datetime-local',
                ],
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
                'attr' => [
                    'type' => 'datetime-local',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chantier::class,
        ]);
    }
}
