<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\Skill;
use App\Entity\User;
use App\Form\UserChantierType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles')
            ->add('password')
            ->add('first_name')
            ->add('last_name')
            ->add('phone')
            ->add('skillid', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
            ])
            // ->add('chantiers', EntityType::class, [
            //     'class' => Chantier::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true,
            //     'mapped' => false,
            // ])
            ->add('userChantiers', CollectionType::class, [
                'entry_type' => UserChantierType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Chantiers',
                'prototype' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
