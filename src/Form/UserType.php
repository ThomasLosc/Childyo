<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
                'maxlength' => '20'
            ],
            'label' => 'Nom :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
        ])
        ->add('prenom', TextType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
                'maxlength' => '20'
            ],
            'label' => 'Prénom :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
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
