<?php

namespace App\Form;

use App\Entity\AutreExperience;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('date_naissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('telephone', TextType::class, [
                'required' => false
            ])
            ->add('quartier', TextType::class, [
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'required' => false
            ])
            ->add('commune', TextType::class, [
                'required' => false
            ])
            ->add('province', TextType::class, [
                'required' => false
            ])
            ->add('rue')
            ->add('autreExperiences', EntityType::class, [
                'class' => AutreExperience::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('niveau_academique')
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
