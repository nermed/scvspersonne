<?php

namespace App\Form;

use App\Entity\AutreExperience;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutreExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'prototype' => true,
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                    'label'=>''
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AutreExperience::class,
        ]);
    }
}
